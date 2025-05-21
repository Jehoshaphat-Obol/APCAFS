<?php 
namespace app\models;

use Yii;
use yii\db\Transaction;
use yii\base\Model;
use yii\helpers\Html;
use app\models\Company;
use app\models\StatusLookup;

class SetupCompany extends Model
{
    // company details
    public $company_name;
    public $company_phone_number;
    public $company_email;
    public $company_address;
    public $company_website_url;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_name', 'company_phone_number', 'company_email', 'company_address', 'company_website_url'], 'trim'],
            [['company_name', 'company_phone_number', 'company_email', 'company_address'], 'required'],
            [['company_name', 'company_email', 'company_address', 'company_website_url'], 'string', 'max' => 255],
            [['company_phone_number'], 'string', 'max' => 10],
            [['company_phone_number'], 'match', 'pattern' => '/^\d{10}$/', 'message' => 'Phone number must be numeric and exactly 10 digits.'],
            [['company_name'], 'unique' , 'targetClass' => '\app\models\Company', 'message' => 'This name has already been taken.'],
            [['company_email'], 'unique' , 'targetClass' => '\app\models\Company', 'message' => 'This email has already been taken.'],
            [['company_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['company_status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'company_name' => Yii::t('app', 'Company Name'),
            'company_phone_number' => Yii::t('app', 'Company Phone Number'),
            'company_email' => Yii::t('app', 'Company Email'),
            'company_address' => Yii::t('app', 'Company Address'),
            'company_website_url' => Yii::t('app', 'Company Website Url'),
        ];
    }

    public function save()
    {
        $transaction = Yii::$app->db->beginTransaction();

        try
        {
            $company = new Company();
            
            $company->company_name = $this->company_name;
            $company->company_phone_number = $this->company_phone_number;
            $company->company_email = $this->company_email;
            $company->company_address = $this->company_address;
            $company->company_website_url = $this->company_website_url;
            $company->company_status_id = StatusLookup::find()->where(['status_code' => 'inactive'])->select('id')->scalar();
            $company->generateActivationCode();

            if(!$company->save())
            {
                throw new \Exception('Failed to Setup Company'. Html::errorSummary($company));
            }

            $transaction->commit();
            return $company->id;
        } catch (\Exception $e)
        {
            $transaction->rollback();
            throw $e;
        }
    }
}
?>