<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company_subscription".
 *
 * @property int $id
 * @property int $subscription_company_id
 * @property int $subscription_plan_id
 * @property string $subscription_start_date
 * @property string $subscription_end_date
 * @property int $subscription_status_id
 * @property string $subscription_created_at
 * @property int|null $subscription_created_by
 * @property string $subscription_updated_at
 * @property int|null $subscription_updated_by
 * @property string|null $subscription_deleted_at
 * @property int|null $subscription_deleted_by
 *
 * @property Company $company
 * @property StatusLookup $statusLookup
 * @property SubscriptionPlan $subscriptionPlan
 * @property User $user
 * @property User $user0
 * @property User $user1
 */
class CompanySubscription extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subscription_created_by', 'subscription_updated_by', 'subscription_deleted_at', 'subscription_deleted_by'], 'default', 'value' => null],
            [['subscription_company_id', 'subscription_plan_id', 'subscription_start_date', 'subscription_end_date', 'subscription_status_id'], 'required'],
            [['subscription_company_id', 'subscription_plan_id', 'subscription_status_id', 'subscription_created_by', 'subscription_updated_by', 'subscription_deleted_by'], 'integer'],
            [['subscription_start_date', 'subscription_end_date', 'subscription_created_at', 'subscription_updated_at', 'subscription_deleted_at'], 'safe'],
            [['subscription_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['subscription_company_id' => 'id']],
            [['subscription_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['subscription_created_by' => 'id']],
            [['subscription_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['subscription_deleted_by' => 'id']],
            [['subscription_plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubscriptionPlan::class, 'targetAttribute' => ['subscription_plan_id' => 'id']],
            [['subscription_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['subscription_status_id' => 'id']],
            [['subscription_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['subscription_updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'subscription_company_id' => Yii::t('app', 'Company'),
            'subscription_plan_id' => Yii::t('app', 'Subscription Plan'),
            'subscription_start_date' => Yii::t('app', 'Start Date'),
            'subscription_end_date' => Yii::t('app', 'End Date'),
            'subscription_status_id' => Yii::t('app', 'Status'),
            'subscription_created_at' => Yii::t('app', 'Created At'),
            'subscription_created_by' => Yii::t('app', 'Created By'),
            'subscription_updated_at' => Yii::t('app', 'Updated At'),
            'subscription_updated_by' => Yii::t('app', 'Updated By'),
            'subscription_deleted_at' => Yii::t('app', 'Deleted At'),
            'subscription_deleted_by' => Yii::t('app', 'Deleted By'),
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery|CompanyQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'subscription_company_id']);
    }

    /**
     * Gets query for [[StatusLookup]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getStatusLookup()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'subscription_status_id']);
    }

    /**
     * Gets query for [[SubscriptionPlan]].
     *
     * @return \yii\db\ActiveQuery|SubscriptionPlanQuery
     */
    public function getSubscriptionPlan()
    {
        return $this->hasOne(SubscriptionPlan::class, ['id' => 'subscription_plan_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'subscription_created_by']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'subscription_deleted_by']);
    }

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::class, ['id' => 'subscription_updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return CompanySubscriptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanySubscriptionQuery(get_called_class());
    }

    public static function companiesWithSubscriptionExpiringSoon($monthsAhead = 2)
    {
        $userCompanyId = Yii::$app->user->id;

        if (!$userCompanyId) {
            return 0;
        }

        $today = (new \DateTime())->format('Y-m-d');
        $twoMonthsLater = (new \DateTime())->modify("+{$monthsAhead} months")->format('Y-m-d');

        return self::find()
            ->where(['>=', 'subscription_end_date', $today])
            ->andWhere(['<=', 'subscription_end_date', $twoMonthsLater])
            ->andWhere(['subscription_company_id' => $userCompanyId])
            ->count();
    }

    public static function companyFollowups()
    {
        $now = new \DateTime();
        $twoMonthsFromNow = (clone $now)->modify('+2 months')->format('Y-m-d');
        $oneMonthFromNow = (clone $now)->modify('+1 month')->format('Y-m-d');
        $today = $now->format('Y-m-d');

        // Tafuta subscription zote zinazokaribia kuisha (bila kuchuja kampuni yoyote)
        $subscriptions = self::find()
            ->alias('cs')
            ->joinWith('company c')
            ->joinWith('user u')
            ->andWhere(['in', 'cs.subscription_end_date', [$twoMonthsFromNow, $oneMonthFromNow, $today]])
            ->orderBy(['cs.subscription_end_date' => SORT_ASC])
            ->all();

        $auth = Yii::$app->authManager;

        foreach ($subscriptions as $subscription) {
            $companyId = $subscription->subscription_company_id;

            // Tafuta watumiaji wote wa kampuni hii
            $companyUsers = \app\models\User::find()->where(['company_id' => $companyId])->all();

            foreach ($companyUsers as $user) {
                // Cheki kama ana role ya 'company-admin'
                if (!$auth->checkAccess($user->id, 'company-admin')) {
                    continue;
                }

                $contactEmail = $user->email;
                $lastEmailSentDate = $subscription->last_email_sent_date;
                $currentDateTime = $now->format('Y-m-d H:i:s');
                $emailSubject = 'Duxte Limited: Subscription Renewal';
                $shouldSendEmail = false;

                if ($subscription->subscription_end_date == $twoMonthsFromNow && $lastEmailSentDate != $twoMonthsFromNow) {
                    $emailSubject .= ' - Initial Notification';
                    $emailBody = "<b>This is your first notification regarding your subscription renewal, with two months remaining.</b><br>Current time: " . Html::encode($currentDateTime);
                    $shouldSendEmail = true;
                    $subscription->last_email_sent_date = $twoMonthsFromNow;

                } elseif ($subscription->subscription_end_date == $oneMonthFromNow && $lastEmailSentDate != $oneMonthFromNow) {
                    $emailSubject .= ' - Second Notification';
                    $emailBody = "<b>This is a reminder to renew your subscription, with one month remaining.</b><br>Current time: " . Html::encode($currentDateTime);
                    $shouldSendEmail = true;
                    $subscription->last_email_sent_date = $oneMonthFromNow;

                } elseif ($subscription->subscription_end_date == $today && $lastEmailSentDate != $today) {
                    $emailSubject .= ' - Final Notification';
                    $emailBody = "<b>Your subscription expires today.</b><br>Current time: " . Html::encode($currentDateTime);
                    $shouldSendEmail = true;
                    $subscription->last_email_sent_date = $today;
                }

                if ($shouldSendEmail) {
                    try {
                        Yii::$app->mailer->compose()
                            ->setFrom(['hassanjemadari@gmail.com' => 'Duxte Co Limited'])
                            ->setTo($contactEmail)
                            ->setCc(['hassanjemadari@gmail.com'])
                            ->setSubject($emailSubject)
                            ->setHtmlBody($emailBody)
                            ->send();

                        // Save mara moja ili tusitume email kwa kila user wa kampuni hiyo (loop ya nje)
                        $subscription->save(false, ['last_email_sent_date']);
                        break; // tumeshatuma email kwa company-admin mmoja, hakuna haja ya kutuma tena
                    } catch (\Exception $e) {
                        Yii::error("Error sending email to {$contactEmail}: " . $e->getMessage(), __METHOD__);
                    }
                }
            }
        }

        return $subscriptions;
    }

    public static function updateSubscriptionStatus($statusFrom, $statusTo, $endDate = null)
    {
        // Set default end date to today if not provided
        $today = (new \DateTime())->format('Y-m-d');
        $endDate = $endDate ?? $today;

        // Fetch all company subscriptions whose end date is equal to or before today
        // and match the current status
        $subscriptions = self::find()
            ->where(['<=', 'subscription_end_date', $endDate])
            ->andWhere(['subscription_status_id' => $statusFrom = StatusLookup::find()->where(['status_code' => 'paid'])->select('id')->scalar()])  // The current status, e.g., 'PAID'
            // ->andWhere(['subscription_company_id' => Yii::$app->user->identity->company_id])
            ->all();

        // Begin transaction for batch processing
        $transaction = Yii::$app->db->beginTransaction();
        try {
            foreach ($subscriptions as $subscription) {
                $statusTo = StatusLookup::find()->where(['status_code' => 'not-paid'])->select('id')->scalar();
                // Update the subscription status
                $subscription->subscription_status_id = $statusTo;  // New status, e.g., 'NOT-PAID'
                if (!$subscription->save(false)) {
                    throw new \Exception('Failed to update subscription status for subscription ID: ' . $subscription->id);
                }
            }

            // Commit the transaction after all subscriptions are updated
            $transaction->commit();
        } catch (\Exception $e) {
            // Rollback the transaction in case of any error
            $transaction->rollBack();
            throw $e;
        }

        return true;
    }
}
