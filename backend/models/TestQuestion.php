<?php

namespace app\models;

use Yii;
use app\models\Company;
use app\models\User;
use app\models\StatusLookup;
use app\models\JobTest;
use app\models\TestQuestionChoice;

/**
 * This is the model class for table "test_question".
 *
 * @property int $id
 * @property int $question_company_id
 * @property int $question_test_id
 * @property string $question
 * @property int $question_status_id
 * @property string $question_created_at
 * @property int|null $question_created_by
 * @property string $question_updated_at
 * @property int|null $question_updated_by
 * @property string|null $question_deleted_at
 * @property int|null $question_deleted_by
 *
 * @property Company $questionCompany
 * @property User $questionCreatedBy
 * @property User $questionDeletedBy
 * @property StatusLookup $questionStatus
 * @property JobTest $questionTest
 * @property User $questionUpdatedBy
 * @property TestQuestionChoice[] $testQuestionChoices
 */
class TestQuestion extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%test_question}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_created_by', 'question_updated_by', 'question_deleted_at', 'question_deleted_by'], 'default', 'value' => null],
            [['question_company_id', 'question_test_id', 'question', 'question_status_id'], 'required'],
            [['question_company_id', 'question_test_id', 'question_status_id', 'question_created_by', 'question_updated_by', 'question_deleted_by'], 'integer'],
            [['question'], 'string'],
            [['question_created_at', 'question_updated_at', 'question_deleted_at'], 'safe'],
            [['question_company_id', 'question_test_id', 'question'], 'unique', 'targetAttribute' => ['question_company_id', 'question_test_id', 'question']],
            [['question_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['question_company_id' => 'id']],
            [['question_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['question_created_by' => 'id']],
            [['question_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['question_deleted_by' => 'id']],
            [['question_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['question_status_id' => 'id']],
            [['question_test_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobTest::class, 'targetAttribute' => ['question_test_id' => 'id']],
            [['question_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['question_updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'question_company_id' => Yii::t('app', 'Question Company ID'),
            'question_test_id' => Yii::t('app', 'Question Test ID'),
            'question' => Yii::t('app', 'Question'),
            'question_status_id' => Yii::t('app', 'Question Status ID'),
            'question_created_at' => Yii::t('app', 'Question Created At'),
            'question_created_by' => Yii::t('app', 'Question Created By'),
            'question_updated_at' => Yii::t('app', 'Question Updated At'),
            'question_updated_by' => Yii::t('app', 'Question Updated By'),
            'question_deleted_at' => Yii::t('app', 'Question Deleted At'),
            'question_deleted_by' => Yii::t('app', 'Question Deleted By'),
        ];
    }

    /**
     * Gets query for [[QuestionCompany]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getQuestionCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'question_company_id']);
    }

    /**
     * Gets query for [[QuestionCreatedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getQuestionCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'question_created_by']);
    }

    /**
     * Gets query for [[QuestionDeletedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getQuestionDeletedBy()
    {
        return $this->hasOne(User::class, ['id' => 'question_deleted_by']);
    }

    /**
     * Gets query for [[QuestionStatus]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getQuestionStatus()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'question_status_id']);
    }

    /**
     * Gets query for [[QuestionTest]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getQuestionTest()
    {
        return $this->hasOne(JobTest::class, ['id' => 'question_test_id']);
    }

    /**
     * Gets query for [[QuestionUpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getQuestionUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'question_updated_by']);
    }

    /**
     * Gets query for [[TestQuestionChoices]].
     *
     * @return \yii\db\ActiveQuery|TestQuestionChoiceQuery
     */
    public function getTestQuestionChoices()
    {
        return $this->hasMany(TestQuestionChoice::class, ['choice_question_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TestQuestionQuery the active query used by this AR class.
     */
    // public static function find()
    // {
    //     return new TestQuestionQuery(get_called_class());
    // }

    /**
     * Soft delete: Inaweka `deleted_at` kwa sasa.
     */
    public function softDelete()
    {
        $this->question_deleted_at = date('Y-m-d H:i:s');
        $this->question_status_id = StatusLookup::find()->where(['status_code' => 'deleted'])->select('id')->scalar();
        $this->question_deleted_by = Yii::$app->user->id;
        return $this->save(false, ['question_deleted_at', 'question_status_id', 'question_deleted_by']);
    }

    /**
     * Restore: Inaondoa thamani ya `deleted_at`.
     */
    public function restore()
    {
        $this->question_deleted_at = null;
        $this->question_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
        $this->question_updated_by = Yii::$app->user->id;
        return $this->save(false, ['question_deleted_at', 'question_status_id', 'question_updated_by']);
    }

    /**
     * Override `find()` ili kuchuja rekodi zilizofutwa kwa default.
     */
    public static function find()
    {
        return parent::find()->where(['question_deleted_at' => null]);
    }

    /**
     * Methodi maalum ya kuchuja na kurudisha rekodi ambazo zimefutwa pekee.
     */
    public static function onlyDeleted()
    {
        return parent::find()->where(['not', ['question_deleted_at' => null]]);
    }

    /**
     * Methodi maalum ya kupata rekodi pamoja na zilizofutwa.
     */
    public static function findWithDeleted()
    {
        return parent::find();
    }
}
