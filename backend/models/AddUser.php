<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Exception;
use yii\helpers\Html;
use app\models\Company;
use app\models\User;
use app\models\StatusLookup;
use yii\helpers\ArrayHelper;

class AddUser extends Model
{
    public $company_id;
    public $username;
    public $email;
    public $password;
    public $roles;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'trim'],
            [['username', 'email'], 'required'],
            [['company_id'], 'integer'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['roles', 'safe'], // Hapa tunaruhusu roles
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'company_id' => Yii::t('app', 'Company Name'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
        ];
    }

    /**
     * Save user.
     *
     * @return bool whether the creating new account was successful and email was sent
     */

    public function save()
    {
        if (!$this->validate()) {
            return false; // Ensure false is returned when validation fails
        }

        $transaction = Yii::$app->db->beginTransaction();

        if (Yii::$app->user->can('super-admin')) {
            try {
                $this->company_id = Yii::$app->user->can('super-admin') ? $this->company_id : Yii::$app->user->identity->company_id;

                $company = Company::findOne($this->company_id);
                if (!$company) {
                    throw new \Exception('Company not found for the given company_id: ' . $this->company_id);
                }

                $generatedString = Yii::$app->security->generateRandomString(8);
                $this->password = $generatedString;

                // Create User
                $user = new User();
                $user->company_id = $company->id;
                $user->username = $this->username;
                $user->email = $this->email;
                $user->setPassword($this->password);
                $user->generateAuthKey();
                $user->generateEmailVerificationToken();
                $user->user_status_id = StatusLookup::find()->where(['status_code' => 'inactive'])->select('id')->scalar();
                $user->created_at = time();
                $user->user_created_by = Yii::$app->user->id;
                $user->updated_at = time();

                if (!$user->save()) {
                    throw new \Exception('Failed to save user: ' . implode(', ', $user->getErrorSummary(true)));
                }

                $auth = Yii::$app->authManager;
            
                // Assign role from the drop-down
                if ($this->roles) {
                    $roleObj = $auth->getRole($this->roles); // Get the selected role
                    if ($roleObj) {
                        $auth->assign($roleObj, $user->id); // Assign the role
                    }
                }

                // // Assign Role
                // $auth = Yii::$app->authManager;
                // $role = Yii::$app->user->can('super-admin') ? 'company-admin' : 'hr';
                // $roleAssignment = $auth->getRole($role);

                // if (!$roleAssignment) {
                //     throw new \Exception("Role '{$role}' not found in authManager");
                // }

                // if (!$auth->assign($roleAssignment, $user->id)) {
                //     throw new \Exception("Unable to assign role");
                // }

                // Commit transaction if all goes well
                $transaction->commit();

                // Send email
                return $this->sendEmail($user, $company);

            } catch (\Exception $e) {
                $transaction->rollback();
                Yii::error($e->getMessage(), 'user-creation');
                throw $e;
            }
        } elseif(Yii::$app->user->can('company-admin'))
        {
            try {
                $company_id = Yii::$app->user->identity->company_id;

                $company = Company::findOne($company_id);
                if (!$company) {
                    throw new \Exception('Company not found for the given company_id: ' . $company_id);
                }

                $generatedString = Yii::$app->security->generateRandomString(8);
                $this->password = $generatedString;

                // Create User
                $user = new User();
                $user->company_id = $company->id;
                $user->username = $this->username;
                $user->email = $this->email;
                $user->setPassword($this->password);
                $user->generateAuthKey();
                $user->generateEmailVerificationToken();
                $user->user_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                $user->created_at = time();
                $user->user_created_by = Yii::$app->user->id;
                $user->updated_at = time();

                if (!$user->save()) {
                    throw new \Exception('Failed to save user: ' . implode(', ', $user->getErrorSummary(true)));
                }

                $auth = Yii::$app->authManager;
            
                // Assign role from the drop-down
                if ($this->roles) {
                    $roleObj = $auth->getRole($this->roles); // Get the selected role
                    if ($roleObj) {
                        $auth->assign($roleObj, $user->id); // Assign the role
                    }
                }
                // Assign Role
                // $auth = Yii::$app->authManager;
                // $roleAssignment = $auth->getRole('hr');

                // if (!$roleAssignment) {
                //     throw new \Exception("Role '{$role}' not found in authManager");
                // }

                // if (!$auth->assign($roleAssignment, $user->id)) {
                //     throw new \Exception("Unable to assign role");
                // }

                // Commit transaction if all goes well
                $transaction->commit();

                // Send email
                return $this->sendSellerEmail($user);

            } catch (\Exception $e) {
                $transaction->rollback();
                Yii::error($e->getMessage(), 'user-creation');
                throw $e;
            }
        }

        return false; // Return false if the user doesn't have the necessary permission
    }

    /**
     * Sends confirmation email to Company admin or Manager
     * @param User $user user model to which email should be sent
     * @param Companies $company company model
     * @param Branches $branch branch model
     * @return bool whether the email was sent
     */
    protected function sendEmail($user, $company)
    {
        // Create the verification link based on user role
        $verifyRoute = 'site/verify-activation';

        $verifyLink = Yii::$app->urlManager->createAbsoluteUrl([
            $verifyRoute,
            'type' => 'company',
            'company_id' => $user->company_id
        ]);

        // Select the correct activation code based on user role
        $activationCode = $company->company_activation_code;

        // Build the email body
        $emailBody = "<p>Habari <b>" . Html::encode($user->username) . "</b>,</p>
            <p>Hongera, umefanikiwa kufanya usajili wa awali wa " . (Yii::$app->user->can('super-admin') ? 'kampuni' : 'tawi') . " yenye jina: 
            <b>" . Html::encode($company->company_name) . "</b>.</p>

            <h3>Fata hatua zifuatazo kukamilisha usajili:</h3>
            <p><b>Hatua 1:</b> Kamilisha usajili kwa kubonyeza link ifuatayo: 
            <p><a href='" . Html::encode($verifyLink) . "' style='display: inline-block; padding: 10px 15px; background-color: #28a745; color: #ffffff; text-decoration: none; border-radius: 5px;'>Ingia Sasa</a></p>
            kisha weka Activation Code: <b>" . Html::encode($activationCode) . "</b>.</p>

            <p><b>Hatua 2:</b> Tumia neno la siri lifuatalo kuweza kuingia kwenye akaunti yako: 
            <b>" . Html::encode($this->password) . "</b></p>

            <p>Kufikia hapo utakuwa umekamilisha usajili pamoja na kuanza rasmi matumizi.</p>
            <p>Ahsante.</p>";

        // Send the email
        return Yii::$app
            ->mailer
            ->compose()
            ->setFrom(['hassanjemadari@gmail.com' => Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('Company Account Registration at ' . Yii::$app->name)
            ->setHtmlBody($emailBody)
            ->send();
    }

    /**
     * Sends confirmation email to Seller
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendSellerEmail($user)
    {
        $company = Company::findOne($user->company_id);
        if (!$company) {
            throw new \Exception('Company not found for the given company_id.');
        }

        $loginUrl = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

        $emailBody = "
            <p><b>Hongera, " . Html::encode($user->username) . "!</b></p>
            <p>Akaunti yako imeundwa kwa mafanikio kwenye <b>" . Html::encode(Yii::$app->name) . "</b>.</p>
            <p><b>Kampuni:</b> " . Html::encode($company->company_name) . "<br>
            <p><b>Taarifa zako za kuingia kwenye mfumo:</b></p>
            <p><b>Jina la mtumiaji:</b> " . Html::encode($user->username) . "<br>
            <b>Nenosiri:</b> " . Html::encode($this->password) . "</p>
            <p>Kwa usalama wa akaunti yako, tunakushauri ubadili nenosiri lako mara baada ya kuingia kwenye mfumo kwa mara ya kwanza.</p>
            <p>Sasa unaweza kuingia kwenye akaunti yako kwa kutumia kiungo kifuatacho:</p>
            <p><a href='" . Html::encode($loginUrl) . "' style='display: inline-block; padding: 10px 15px; background-color: #28a745; color: #ffffff; text-decoration: none; border-radius: 5px;'>Ingia Sasa</a></p>
            <p>Ikiwa hukufanya usajili huu, tafadhali wasiliana nasi mara moja.</p>
            <br>
            <p>Ahsante,</p>
            <p><b>DFF Co Limited</b></p>
        ";

        return Yii::$app
            ->mailer
            ->compose()
            ->setFrom(['hassanjemadari@gmail.com' => Yii::$app->name])
            ->setTo($user->email)
            ->setSubject('Akaunti Yako Imekamilika - ' . Yii::$app->name)
            ->setHtmlBody($emailBody)
            ->send();
    }

    // Method ya kupata roles zote
    public function getRolesList()
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name');
    }

}

?>