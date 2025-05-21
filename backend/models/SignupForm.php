<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Transaction;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Company;
use app\models\StatusLookup;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $company_id;
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            ['company_id', 'required'],
            ['company_id', 'integer'],
            [['company_id'], 'exist', 'targetClass' => '\app\models\Company', 'targetAttribute' => 'id'],

            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 3],
        ];
    }


    public function signup()
    {
            if (!$this->validate()) {
                Yii::error("Validation failed: " . json_encode($this->errors)); // Log validation errors
                return false;
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {
                $user = new User();
                $user->username = $this->username;
                $user->email = $this->email;
                $user->setPassword($this->password);
                $user->generateAuthKey();
                $user->generateEmailVerificationToken();
                $user->company_id = $this->company_id;
                $user->user_status_id = StatusLookup::find()->where(['status_code' => 'inactive'])->select('id')->scalar();
                $user->created_at = time();
                $user->updated_at = time();

            //     
            if (!$user->save()) {
                Yii::error("Failed to save user: " . json_encode($user->errors)); // Log save errors
                return false;
            }

            // Send email
            if (!$this->sendEmail($user)) {
                Yii::error("Failed to send email to user."); // Log email errors
                return false;
            }

            // Assign role
            $auth = Yii::$app->authManager;
            $adminRole = $auth->getRole('super-admin');
            if (!$auth->assign($adminRole, $user->id)) {
                Yii::error("Failed to assign role to user."); // Log role assignment errors
                return false;
            }

            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::error("Error occurred during signup: " . $e->getMessage());
            return false;
        }
    }

    protected function sendEmail($user)
    {
        $company = Company::findOne($user->company_id);
        if (!$company) {
            throw new \Exception('Company not found for the given company_id.');
        }

        $emailBody = "<b>Hongera, Umefanikiwa kufanya setup ya kampuni " . Html::encode($company->company_name) . ", Kamilisha usajili kwa kuweka Activation Code: <b>" . Html::encode($company->company_activation_code) . "</b>. Ahsante";

        return Yii::$app
            ->mailer
            ->compose()
            ->setFrom(['hassanjemadari@gmail.com' => Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('Company Account Registration at ' . Yii::$app->name)
            ->setHtmlBody($emailBody)
            ->send();
    }
}

