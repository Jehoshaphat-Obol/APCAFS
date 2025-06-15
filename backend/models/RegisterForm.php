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
class RegisterForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $agreeToTerms;


    public function rules()
    {
        return [
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
            ['agreeToTerms', 'required', 'requiredValue' => 1, 'message' => 'You must agree to the terms and policies.'],
        ];
    }

    public function register()
    {
        if (!$this->validate()) {
            Yii::error("Validation failed: " . json_encode($this->errors)); // Log validation errors
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();
        try 
        {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            $user->user_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
            $user->created_at = time();
            $user->updated_at = time();

            //     
            if (!$user->save()) {
                Yii::error("Failed to save user: " . json_encode($user->errors)); // Log save errors
                return false;
            }

            // Assign role
            $auth = Yii::$app->authManager;
            $applicantRole = $auth->getRole('applicant');
            if (!$auth->assign($applicantRole, $user->id)) {
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
}

