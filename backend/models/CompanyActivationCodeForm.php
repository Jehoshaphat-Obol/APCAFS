<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Transaction;
use app\models\User;
use app\models\Company;

class CompanyActivationCodeForm extends Model
{
    public $company_id;
    public $company_activation_code;

    public function rules()
    {
        return [
            [['company_activation_code'], 'required'],
            [['company_activation_code'], 'string', 'max' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'company_activation_code' => Yii::t('app', 'Company Activation Code'),
        ];
    }

    public function save()
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $company = Company::findOne($this->company_id);
            $user = User::findOne(['company_id' => $this->company_id]);

            if ($company && $user) {
                // Hakikisha code ni sahihi
                if ($company->company_activation_code === $this->company_activation_code) {
                    // Activate Company
                    $company->company_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                    $company->company_activation_code = 'ydaerla' . Yii::$app->security->generateRandomString(8) . 'sdesu';
                    $company->company_activation_code_date = date('Y-m-d H:i:s');
                    $company->save();

                    // Activate User
                    $user->user_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                    $user->save();

                    $transaction->commit();
                    return true;
                } else {
                    Yii::$app->session->setFlash('error', 'Invalid activation code.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Company or user not found.');
            }

            $transaction->rollBack();
            return false;

        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::error("Activation error: " . $e->getMessage());
            Yii::$app->session->setFlash('error', 'An error occurred during activation.');
            return false;
        }
    }
}
?>
