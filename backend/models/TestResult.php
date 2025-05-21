<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_result".
 *
 * @property int $id
 * @property int $result_company_id
 * @property int $result_test_id
 * @property int $result_user_id
 * @property float|null $result_score
 * @property int $result_status_id
 * @property string $result_created_at
 * @property int|null $result_created_by
 * @property string $result_updated_at
 * @property int|null $result_updated_by
 * @property string|null $result_deleted_at
 * @property int|null $result_deleted_by
 *
 * @property Company $company
 * @property JobTest $jobTest
 * @property StatusLookup $statusLookup
 * @property User $user
 * @property User $user0
 * @property User $user1
 * @property User $user2
 */
class TestResult extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test_result';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['result_score', 'result_created_by', 'result_updated_by', 'result_deleted_at', 'result_deleted_by'], 'default', 'value' => null],
            [['result_company_id', 'result_test_id', 'result_user_id', 'result_status_id'], 'required'],
            [['result_company_id', 'result_test_id', 'result_user_id', 'result_status_id', 'result_created_by', 'result_updated_by', 'result_deleted_by'], 'integer'],
            [['result_score'], 'number'],
            [['result_created_at', 'result_updated_at', 'result_deleted_at'], 'safe'],
            [['result_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['result_company_id' => 'id']],
            [['result_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['result_created_by' => 'id']],
            [['result_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['result_deleted_by' => 'id']],
            [['result_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['result_status_id' => 'id']],
            [['result_test_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobTest::class, 'targetAttribute' => ['result_test_id' => 'id']],
            [['result_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['result_updated_by' => 'id']],
            [['result_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['result_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'result_company_id' => Yii::t('app', 'Result Company ID'),
            'result_test_id' => Yii::t('app', 'Result Test ID'),
            'result_user_id' => Yii::t('app', 'Result User ID'),
            'result_score' => Yii::t('app', 'Result Score'),
            'result_status_id' => Yii::t('app', 'Result Status ID'),
            'result_created_at' => Yii::t('app', 'Result Created At'),
            'result_created_by' => Yii::t('app', 'Result Created By'),
            'result_updated_at' => Yii::t('app', 'Result Updated At'),
            'result_updated_by' => Yii::t('app', 'Result Updated By'),
            'result_deleted_at' => Yii::t('app', 'Result Deleted At'),
            'result_deleted_by' => Yii::t('app', 'Result Deleted By'),
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery|CompanyQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'result_company_id']);
    }

    /**
     * Gets query for [[JobTest]].
     *
     * @return \yii\db\ActiveQuery|JobTestQuery
     */
    public function getJobTest()
    {
        return $this->hasOne(JobTest::class, ['id' => 'result_test_id']);
    }

    /**
     * Gets query for [[StatusLookup]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getStatusLookup()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'result_status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'result_created_by']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'result_deleted_by']);
    }

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::class, ['id' => 'result_updated_by']);
    }

    /**
     * Gets query for [[User2]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser2()
    {
        return $this->hasOne(User::class, ['id' => 'result_user_id']);
    }

    /**
     * {@inheritdoc}
     * @return TestResultQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TestResultQuery(get_called_class());
    }

}
