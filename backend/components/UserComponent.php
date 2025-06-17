<?php

namespace app\components;

use Yii;
use yii\web\User;

class UserComponent extends User
{
    public function afterLogin($identity, $cookieBased, $duration)
    {
        parent::afterLogin($identity, $cookieBased, $duration);

        if (Yii::$app->authManager->checkAccess($identity->id, 'super-admin')) {
            Yii::$app->response->redirect(['dashboard/super-admin-dashboard'])->send();
            Yii::$app->end();
        } elseif (Yii::$app->authManager->checkAccess($identity->id, 'company-admin')) {
            Yii::$app->response->redirect(['dashboard/company-admin-dashboard'])->send();
            Yii::$app->end();
        } elseif (Yii::$app->authManager->checkAccess($identity->id, 'manager')) {
            Yii::$app->response->redirect(['dashboard/manager-dashboard'])->send();
            Yii::$app->end();
        } elseif (Yii::$app->authManager->checkAccess($identity->id, 'hr')) {
            Yii::$app->response->redirect(['dashboard/hr-dashboard'])->send();
            Yii::$app->end();
        } elseif (Yii::$app->authManager->checkAccess($identity->id, 'applicant')) {
            Yii::$app->response->redirect(['dashboard/applicant-dashboard'])->send();
            Yii::$app->end();
        } else {
            Yii::$app->response->redirect(['dashboard/default'])->send();
            Yii::$app->end();
        }
    }
}
