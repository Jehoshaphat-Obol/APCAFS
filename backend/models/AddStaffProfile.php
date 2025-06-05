<?php 
    namespace app\models;

    use Yii;
    use yii\base\Model;
    use app\models\StaffProfile;
    use yii\db\Transaction;
    use yii\helpers\Html;

    class AddStaffProfile extends Model
    {
        // company details
        public $staff_first_name;
        public $staff_middle_name;
        public $staff_last_name;
        public $staff_phone_number;


        /**
         * {@inheritdoc}
         */
        public function rules()
        {
            return [
                [['staff_first_name', 'staff_middle_name', 'staff_last_name', 'staff_phone_number'], 'trim'],
                [['staff_first_name', 'staff_last_name', 'staff_phone_number'], 'required'],
                [['staff_company_id', 'staff_user_id', 'staff_status_id', 'staff_created_by'], 'integer'],
                [['staff_created_at', 'staff_updated_at', 'staff_deleted_at'], 'safe'],
                [['staff_first_name', 'staff_middle_name', 'staff_last_name'], 'string', 'max' => 100],
                [['staff_phone_number'], 'string', 'max' => 10],
                [['staff_phone_number'], 'match', 'pattern' => '/^\d{10}$/', 'message' => 'Phone number must be numeric and exactly 10 digits.'],
                [['staff_company_id', 'staff_user_id', 'staff_first_name', 'staff_last_name', 'staff_phone_number'], 'unique', 'targetAttribute' => ['staff_company_id', 'staff_user_id', 'staff_first_name', 'staff_last_name', 'staff_phone_number']],
            ];
        }

        /**
         * {@inheritdoc}
         */
        public function attributeLabels()
        {
            return [
                'staff_first_name' => Yii::t('app', 'Staff First Name'),
                'staff_middle_name' => Yii::t('app', 'Staff Middle Name'),
                'staff_last_name' => Yii::t('app', 'Staff Last Name'),
                'staff_phone_number' => Yii::t('app', 'Staff Phone Number'),
            ];
        }

        public function save()
        {
            $transaction = Yii::$app->db->beginTransaction();

            try
            {
                if(Yii::$app->user->can('company-admin') || Yii::$app->user->can('manager') || Yii::$app->user->can('hr'))
                {
                    $profile = new StaffProfile();
                    $profile->staff_company_id = Yii::$app->user->identity->company_id;
                    $profile->staff_user_id = Yii::$app->user->id;
                    $profile->staff_first_name = $this->staff_first_name;
                    $profile->staff_middle_name = $this->staff_middle_name;
                    $profile->staff_last_name = $this->staff_last_name;
                    $profile->staff_phone_number = $this->staff_phone_number;
                    $profile->staff_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
                    $profile->staff_created_by = Yii::$app->user->id;

                    if(!$profile->save())
                    {
                        throw new \Exception('Failed to save your profile'. Html::errorSummary($profile));
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
            }
        }
    }
?>