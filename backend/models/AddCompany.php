<?php 
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Company;
use app\models\CompanySubscription;
use app\models\SubscriptionPlan;
use app\models\StatusLookup;

class AddCompany extends Model
{
    // company details
    public $id;
    public $company_name;
    public $company_phone_number;
    public $company_email;
    public $company_address;
    public $company_user_size;
    public $company_website_url;

    // subscription
    public $subscription_plan_id;

    const USER_SIZE = 5;

    public function rules()
    {
        return [
            [['company_name', 'company_email', 'company_address', 'company_website_url'], 'trim'],
            [['company_name', 'company_phone_number', 'company_email', 'company_address', 'subscription_plan_id'], 'required'],
            [['company_name', 'company_email', 'company_address', 'company_website_url'], 'string', 'max' => 255],
            [['company_phone_number'], 'string', 'max' => 10],
            [['company_phone_number'], 'match', 'pattern' => '/^\d{10}$/', 'message' => 'Phone number must be numeric and exactly 10 digits.'],
            [['company_user_size', 'subscription_plan_id'], 'integer'],

            [['company_name'], 'unique', 'targetClass' => Company::class, 'targetAttribute' => 'company_name', 'filter' => function ($query) {
                if ($this->id) {
                    $query->andWhere(['not', ['id' => $this->id]]);
                }
            }],

            [['company_email'], 'unique', 'targetClass' => Company::class, 'targetAttribute' => 'company_email', 'filter' => function ($query) {
                if ($this->id) {
                    $query->andWhere(['not', ['id' => $this->id]]);
                }
            }],

            [['subscription_plan_id'], 'exist', 'targetClass' => SubscriptionPlan::class, 'targetAttribute' => 'id'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'company_name' => Yii::t('app', 'Company Name'),
            'company_phone_number' => Yii::t('app', 'Phone Number'),
            'company_email' => Yii::t('app', 'Email'),
            'company_address' => Yii::t('app', 'Address'),
            'company_user_size' => Yii::t('app', 'Company User Size'),
            'company_website_url' => Yii::t('app', 'Company Website Url'),
            'subscription_plan_id' => Yii::t('app', 'Subscription Plan'),
        ];
    }

    public function save()
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if (!Yii::$app->user->can('super-admin')) {
                throw new \Exception("Forbidden to perform this action.");
            }

            $company = new Company();
            $this->assignCompanyFields($company);

            $company->generateActivationCode();
            $company->company_status_id = StatusLookup::find()->where(['status_code' => 'inactive'])->select('id')->scalar();

            if (!$company->save()) {
                throw new \Exception('Failed to register new company: ' . implode(', ', $company->getFirstErrors()));
            }

            $plan = SubscriptionPlan::findOne($this->subscription_plan_id);
            if (!$plan) {
                throw new \Exception('Subscription plan does not exist.');
            }

            $period = $this->calculateSubscriptionPeriod($plan);

            $subscription = new CompanySubscription([
                'subscription_company_id' => $company->id,
                'subscription_plan_id' => $this->subscription_plan_id,
                'subscription_start_date' => $period['start_date'],
                'subscription_end_date' => $period['end_date'],
                'subscription_status_id' => StatusLookup::find()->where(['status_code' => 'paid'])->select('id')->scalar(),
                'subscription_created_by' => Yii::$app->user->id,
            ]);

            if (!$subscription->save()) {
                throw new \Exception('Failed to save subscription: ' . implode(', ', $subscription->getFirstErrors()));
            }

            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    public function update($id)
    {
        $this->id = $id;

        $transaction = Yii::$app->db->beginTransaction();

        try {
            if (!Yii::$app->user->can('super-admin')) {
                throw new \Exception("You are not allowed to perform this action.");
            }

            $company = Company::findOne($id);
            if (!$company) {
                throw new \Exception("Company not found.");
            }

            $this->assignCompanyFields($company);

            if (!$company->save()) {
                throw new \Exception('Failed to update company: ' . implode(', ', $company->getFirstErrors()));
            }

            $plan = SubscriptionPlan::findOne($this->subscription_plan_id);
            if (!$plan) {
                throw new \Exception("Subscription plan not found.");
            }

            $period = $this->calculateSubscriptionPeriod($plan);

            $subscription = CompanySubscription::find()
                ->where(['subscription_company_id' => $company->id])
                ->orderBy(['id' => SORT_DESC])
                ->one();

            if (!$subscription) {
                $subscription = new CompanySubscription();
                $subscription->subscription_company_id = $company->id;
                $subscription->subscription_created_by = Yii::$app->user->id;
            }

            $subscription->subscription_plan_id = $this->subscription_plan_id;
            $subscription->subscription_start_date = $period['start_date'];
            $subscription->subscription_end_date = $period['end_date'];
            $subscription->subscription_status_id = StatusLookup::find()
                ->where(['status_code' => 'paid'])
                ->select('id')
                ->scalar();

            if (!$subscription->save()) {
                throw new \Exception('Failed to update subscription: ' . implode(', ', $subscription->getFirstErrors()));
            }

            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    protected function assignCompanyFields($company)
    {
        $company->company_name = $this->company_name;
        $company->company_phone_number = $this->company_phone_number;
        $company->company_email = $this->company_email;
        $company->company_address = $this->company_address;
        $company->company_user_size = $this->company_user_size ?: $this->defaultCompanyUserSize();
        $company->company_website_url = $this->company_website_url;
    }

    protected function defaultCompanyUserSize()
    {
        return self::USER_SIZE;
    }

    protected function calculateSubscriptionPeriod(SubscriptionPlan $plan, $startDate = null)
    {
        $start = $startDate ? new \DateTime($startDate) : new \DateTime();
        $duration = (int) $plan->subscription_plan_duration;
        $type = strtolower($plan->subscription_plan_duration_type);

        switch ($type) {
            case 'day':
            case 'days':
                $intervalSpec = "P{$duration}D";
                break;
            case 'week':
            case 'weeks':
                $intervalSpec = "P{$duration}W";
                break;
            case 'month':
            case 'months':
                $intervalSpec = "P{$duration}M";
                break;
            case 'year':
            case 'years':
                $intervalSpec = "P{$duration}Y";
                break;
            default:
                throw new \Exception("Invalid subscription duration type: $type");
        }

        $end = clone $start;
        $end->add(new \DateInterval($intervalSpec));

        return [
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
        ];
    }
}
