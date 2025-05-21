<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscription_plan".
 *
 * @property int $id
 * @property int $subscription_plan_duration
 * @property string $subscription_plan_duration_type
 * @property int $subscription_plan_status_id
 * @property string $subscription_plan_created_at
 * @property int|null $subscription_plan_created_by
 * @property string $subscription_plan_updated_at
 * @property int|null $subscription_plan_updated_by
 * @property string|null $subscription_plan_deleted_at
 * @property int|null $subscription_plan_deleted_by
 *
 * @property CompanySubscription[] $companySubscriptions
 * @property StatusLookup $statusLookup
 */
class SubscriptionPlan extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscription_plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subscription_plan_created_by', 'subscription_plan_updated_by', 'subscription_plan_deleted_at', 'subscription_plan_deleted_by'], 'default', 'value' => null],
            [['subscription_plan_duration'], 'default', 'value' => 1],
            [['subscription_plan_duration_type'], 'default', 'value' => 'months'],
            [['subscription_plan_duration', 'subscription_plan_status_id', 'subscription_plan_created_by', 'subscription_plan_updated_by', 'subscription_plan_deleted_by'], 'integer'],
            [['subscription_plan_status_id'], 'required'],
            [['subscription_plan_created_at', 'subscription_plan_updated_at', 'subscription_plan_deleted_at'], 'safe'],
            [['subscription_plan_duration_type'], 'string', 'max' => 10],
            [['subscription_plan_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['subscription_plan_status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'subscription_plan_duration' => Yii::t('app', 'Subscription Plan Duration'),
            'subscription_plan_duration_type' => Yii::t('app', 'Subscription Plan Duration Type'),
            'subscription_plan_status_id' => Yii::t('app', 'Subscription Plan Status ID'),
            'subscription_plan_created_at' => Yii::t('app', 'Subscription Plan Created At'),
            'subscription_plan_created_by' => Yii::t('app', 'Subscription Plan Created By'),
            'subscription_plan_updated_at' => Yii::t('app', 'Subscription Plan Updated At'),
            'subscription_plan_updated_by' => Yii::t('app', 'Subscription Plan Updated By'),
            'subscription_plan_deleted_at' => Yii::t('app', 'Subscription Plan Deleted At'),
            'subscription_plan_deleted_by' => Yii::t('app', 'Subscription Plan Deleted By'),
        ];
    }

    /**
     * Gets query for [[CompanySubscriptions]].
     *
     * @return \yii\db\ActiveQuery|CompanySubscriptionQuery
     */
    public function getCompanySubscriptions()
    {
        return $this->hasMany(CompanySubscription::class, ['subscription_plan_id' => 'id']);
    }

    /**
     * Gets query for [[StatusLookup]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getStatusLookup()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'subscription_plan_status_id']);
    }

    /**
     * {@inheritdoc}
     * @return SubscriptionPlanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubscriptionPlanQuery(get_called_class());
    }

    public function getFormattedDuration()
    {
        $duration = $this->subscription_plan_duration;
        $type = $this->subscription_plan_duration_type;

        // Basic plural logic
        $typeFormatted = ($duration > 1) ? rtrim($type, 's') . 's' : rtrim($type, 's');

        return "$duration $typeFormatted";
    }

}
