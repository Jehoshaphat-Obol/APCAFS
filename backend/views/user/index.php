<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(Yii::$app->user->can('super-admin') || Yii::$app->user->can('company-admin') || Yii::$app->user->can('manager')): ?>
        <?php if($company->companyUserCheckLimit()): ?>
            <p>
                <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        <?php endif; ?>
    <?php endif; ?>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php 
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],
        ];

        if(Yii::$app->user->can('super-admin'))
        {
            $columns[] = [
                'attribute' => 'company_id',
                'value' => 'company.company_name'
            ];
        }
        
        $columns[] = 'username';
        $columns[] = 'email:email';
        $columns[] = [
            // 'label' => 'Roles',
            'attribute' => 'roles',
            'filter' => Html::activeDropDownList($searchModel, 'roles', 
                \yii\helpers\ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name'), 
                ['class' => 'form-control', 'prompt' => 'Select Role']
            ),
            'content' => function($model) {
                $roles = Yii::$app->authManager->getRolesByUser($model->id);
                return implode(', ', array_keys($roles)); 
            },
            'headerOptions' => ['style' => 'color: #007bff; text-decoration: underline; font-weight: bold;'], // Mabadiliko ya mtindo wa header
        ];
        $columns[] = [
            'attribute' => 'user_status_id',
            'value' => 'userStatus.status_name'
        ];
        $columns[] = [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, User $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            }
        ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
    ]); ?>

    <?php Pjax::end(); ?>

</div>
