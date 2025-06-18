<?php

namespace app\models;

use yii\base\Model;
use app\models\User;
use Yii;

class ResetPasswordForm extends Model
{
    public $password;
    private $_user;

    public function __construct($token, $config = [])
    {
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new \yii\base\InvalidParamException('Token si halali.');
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        return $user->save(false);
    }
}
