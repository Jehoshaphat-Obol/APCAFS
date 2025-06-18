<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\StatusLookup;
class PasswordResetRequestForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => User::class,
                'filter' => ['user_status_id' => StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar()],
                'message' => 'There is no user with this email address.'
            ],
        ];
    }

    public function sendEmail()
    {
        $user = User::findOne([
            'user_status_id' => StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar(),
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }

        $user->generatePasswordResetToken();
        if (!$user->save()) {
            return false;
        }

        return Yii::$app
            ->mailer
            ->compose('@backend/views/mail/passwordResetToken', ['user' => $user])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('Password Reset for ' . Yii::$app->name)
            ->send();
    }
}
