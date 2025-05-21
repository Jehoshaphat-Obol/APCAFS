<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class ChangePassword extends Model
{
    public $id;
    public $oldPassword;
    public $newPassword;
    public $confirmPassword;


    public function rules()
    {
        return [
            [['oldPassword', 'newPassword', 'confirmPassword'], 'required'],
            [['oldPassword', 'newPassword', 'confirmPassword'], 'string', 'min' => 3],
            ['confirmPassword', 'compare', 'compareAttribute' => 'newPassword'],
            [['oldPassword'], 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'oldPassword' => 'Current Password',
            'newPassword' => 'New Password',
            'confirmPassword' => 'Confirm New Password',
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = User::findOne(['id' => $this->id]);
            if (!$user || !$user->validatePassword($this->oldPassword)) {
                $this->addError($attribute, 'Incorrect password.');
            }
        }
    }

    public function save()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $currentUserId = Yii::$app->user->id;
            $user = User::findOne(['id' => $currentUserId]);
            if (!$user || !$user->validatePassword($this->oldPassword)) 
            {
                throw new \Exception('Incorrect Current Password');
            }

            $user->setPassword($this->newPassword);
            if (!$user->save()) {
                throw new \Exception('Unable to save new password');
            }

            $transaction->commit();
            return true; // Indicate successful password change
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
    }
}