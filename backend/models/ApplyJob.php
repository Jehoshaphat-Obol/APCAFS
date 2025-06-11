<?php 
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\JobApplication;
use yii\db\Transaction;
use yii\helpers\Html;

class ApplyJob extends Model
{
    // company details
    public $post_company_id;
    public $post_job_id;


    public function apply()
    {
        $transaction = Yii::$app->db->beginTransaction();

        try
        {
            if(Yii::$app->user->can('applicant'))
            {
                $apply = new JobApplication();
                $apply->applicant_company_id = $this->post_company_id;
                $apply->applicant_job_post_id = $this->post_job_id;
                $apply->applicant_user_id = Yii::$app->user->id;
                $apply->applicant_status_id = StatusLookup::find()->where(['status_code' => 'apply'])->select('id')->scalar();
                $apply->applicant_created_by = Yii::$app->user->id;

                if(!$apply->save())
                {
                    throw new \Exception('Failed to Apply for this Job'. Html::errorSummary($apply));
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