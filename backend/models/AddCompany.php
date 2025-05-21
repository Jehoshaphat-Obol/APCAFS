<?php 
    namespace app\models;

    use Yii;
    use yii\base\Model;
    use app\models\Company;
    use app\models\CompanySubscription;
    use yii\db\Transaction;
    use yii\helpers\Html;

    class AddCompany extends Model
    {
        // company details
        public $company_name;
        public $company_phone_number;
        public $company_email;
        public $company_address;
        public $company_user_size;
        public $company_website_url;

        // company subscription details
        public $subscription_plan_id;


        /**
         * {@inheritdoc}
         */
        public function rules()
        {
            return [
                [['company_name', 'company_email', 'company_address', 'company_website_url'], 'trim'],
                [['company_name', 'company_phone_number', 'company_email', 'company_address','subscription_plan_id'], 'required'],
                [['company_name', 'company_email', 'company_address', 'company_website_url'], 'string', 'max' => 255],
                [['company_phone_number'], 'string', 'max' => 10],
                [['company_phone_number'], 'match', 'pattern' => '/^\d{10}$/', 'message' => 'Phone number must be numeric and exactly 10 digits.'],
                [['company_user_size', 'subscription_plan_id'], 'integer'],
                [['company_name'], 'unique' , 'targetClass' => '\app\models\Companies', 'message' => 'This name has already been taken.'],
                [['company_email'], 'unique' , 'targetClass' => '\app\models\Companies', 'message' => 'This email has already been taken.'],
                [['subscription_plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubscriptionPlan::class, 'targetAttribute' => ['subscription_plan_id' => 'id']],
            ];
        }

        /**
         * {@inheritdoc}
         */
        public function attributeLabels()
        {
            return [
                'company_name' => Yii::t('app', 'Company Name'),
                'company_phone_number' => Yii::t('app', 'Phone Number'),
                'company_email' => Yii::t('app', 'Email'),
                'company_address' => Yii::t('app', 'Address'),
                'company_user_size' => Yii::t('app', 'Company User Size'),
                'subscription_plan_id' => Yii::t('app', 'Subscription Plan'),
            ];
        }

        public function save()
        {
            $transaction = Yii::$app->db->beginTransaction();

            try
            {
                if(Yii::$app->user->can('super-admin'))
                {
                    $company = new Company();
                    if(empty($this->company_user_size))
                    {
                        $company->company_name = $this->company_name;
                        $company->company_phone_number = $this->company_phone_number;
                        $company->company_email = $this->company_email;
                        $company->company_address = $this->company_address;
                        $company->company_user_size = $this->defaultCompanyUserSize();
                        $company->company_website_url = $this->company_website_url;
                        $company->generateActivationCode();
                        $company->company_status_id = StatusLookup::find()->where(['status_code' => 'inactive'])->select('id')->scalar();
                    } else {
                        $company->company_name = $this->company_name;
                        $company->company_phone_number = $this->company_phone_number;
                        $company->company_email = $this->company_email;
                        $company->company_address = $this->company_address;
                        $company->company_user_size = $this->company_user_size;
                        $company->company_website_url = $this->company_website_url;
                        $company->generateActivationCode();
                        $company->company_status_id = StatusLookup::find()->where(['status_code' => 'inactive'])->select('id')->scalar();
                    }

                    if(!$company->save())
                    {
                        throw new \Exception('Failed to register New company'. Html::errorSummary($company));
                    }

                    $subscription = new CompanySubscription();

                    // tunacheki ikiwa hii subscription plan ni valid
                    $plan = SubscriptionPlan::findOne(['id' => $this->subscription_plan_id]);
                    if($plan)
                    {
                        $subscription->subscription_company_id = $company->id;
                        $subscription->subscription_plan_id = $this->subscription_plan_id;

                        $period = $this->calculateSubscriptionPeriod($plan); 

                        $subscription->subscription_start_date = $period['start_date'];
                        $subscription->subscription_end_date = $period['end_date'];
                        $subscription->subscription_status_id = StatusLookup::find()->where(['status_code' => 'paid'])->select('id')->scalar();
                        $subscription->subscription_created_by = Yii::$app->user->id;
                    } else
                    {
                        throw new \Exception('subscription plan does not exist');
                    }

                    if(!$subscription->save())
                    {
                        throw new \Exception('Failed to plan subscription');
                    }

                    $transaction->commit();
                    return true;
                }
                throw new \Exception("Forbidden to perform this action");
                return false;
            } catch(\Exception $e)
            {
                $transaction->rollback();
                throw $e;
                return false;
            }
        }

        protected function defaultCompanyUserSize()
        {
            return $this->company_user_size = self::USER_SIZE;
        }

        protected function calculateSubscriptionPeriod(SubscriptionPlan $plan, $startDate = null)
        {
            $start = $startDate ? new \DateTime($startDate) : new \DateTime(); // sasa hivi
            $duration = (int) $plan->subscription_plan_duration;
            $type = strtolower($plan->subscription_plan_duration_type);

            // Normalize type (e.g. 'Month', 'Months', 'month', etc.)
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
?>