<?php

namespace app\models;

use Yii;
use app\models\Company;
use app\models\User;
use app\models\TestQuestion;
use app\models\StatusLookup;

/**
 * This is the model class for table "test_question_choice".
 *
 * @property int $id
 * @property int $choice_company_id
 * @property int $choice_question_id
 * @property string $choice_label
 * @property string $choice_text
 * @property int $choice_is_correct
 * @property int $choice_status_id
 * @property string $choice_created_at
 * @property int|null $choice_created_by
 * @property string $choice_updated_at
 * @property int|null $choice_updated_by
 * @property string|null $choice_deleted_at
 * @property int|null $choice_deleted_by
 *
 * @property Company $choiceCompany
 * @property User $choiceCreatedBy
 * @property User $choiceDeletedBy
 * @property TestQuestion $choiceQuestion
 * @property StatusLookup $choiceStatus
 * @property User $choiceUpdatedBy
 */
class TestQuestionChoice extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%test_question_choice}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['choice_created_by', 'choice_updated_by', 'choice_deleted_at', 'choice_deleted_by'], 'default', 'value' => null],
            [['choice_is_correct'], 'default', 'value' => 0],
            [['choice_company_id', 'choice_question_id', 'choice_label', 'choice_text', 'choice_status_id'], 'required'],
            [['choice_company_id', 'choice_question_id', 'choice_is_correct', 'choice_status_id', 'choice_created_by', 'choice_updated_by', 'choice_deleted_by'], 'integer'],
            [['choice_text'], 'string'],
            [['choice_created_at', 'choice_updated_at', 'choice_deleted_at'], 'safe'],
            [['choice_label'], 'string', 'max' => 1],
            [['choice_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['choice_company_id' => 'id']],
            [['choice_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['choice_created_by' => 'id']],
            [['choice_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['choice_deleted_by' => 'id']],
            [['choice_question_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestQuestion::class, 'targetAttribute' => ['choice_question_id' => 'id']],
            [['choice_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['choice_status_id' => 'id']],
            [['choice_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['choice_updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'choice_company_id' => Yii::t('app', 'Choice Company ID'),
            'choice_question_id' => Yii::t('app', 'Choice Question ID'),
            'choice_label' => Yii::t('app', 'Choice Label'),
            'choice_text' => Yii::t('app', 'Choice Text'),
            'choice_is_correct' => Yii::t('app', 'Choice Is Correct'),
            'choice_status_id' => Yii::t('app', 'Choice Status ID'),
            'choice_created_at' => Yii::t('app', 'Choice Created At'),
            'choice_created_by' => Yii::t('app', 'Choice Created By'),
            'choice_updated_at' => Yii::t('app', 'Choice Updated At'),
            'choice_updated_by' => Yii::t('app', 'Choice Updated By'),
            'choice_deleted_at' => Yii::t('app', 'Choice Deleted At'),
            'choice_deleted_by' => Yii::t('app', 'Choice Deleted By'),
        ];
    }

    /**
     * Gets query for [[ChoiceCompany]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getChoiceCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'choice_company_id']);
    }

    /**
     * Gets query for [[ChoiceCreatedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getChoiceCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'choice_created_by']);
    }

    /**
     * Gets query for [[ChoiceDeletedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getChoiceDeletedBy()
    {
        return $this->hasOne(User::class, ['id' => 'choice_deleted_by']);
    }

    /**
     * Gets query for [[ChoiceQuestion]].
     *
     * @return \yii\db\ActiveQuery|TestQuestionQuery
     */
    public function getChoiceQuestion()
    {
        return $this->hasOne(TestQuestion::class, ['id' => 'choice_question_id']);
    }

    /**
     * Gets query for [[ChoiceStatus]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getChoiceStatus()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'choice_status_id']);
    }

    /**
     * Gets query for [[ChoiceUpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getChoiceUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'choice_updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return TestQuestionChoiceQuery the active query used by this AR class.
     */
    // public static function find()
    // {
    //     return new TestQuestionChoiceQuery(get_called_class());
    // }

    /**
     * Soft delete: Inaweka `deleted_at` kwa sasa.
     */
    public function softDelete()
    {
        $this->choice_deleted_at = date('Y-m-d H:i:s');
        $this->choice_status_id = StatusLookup::find()->where(['status_code' => 'deleted'])->select('id')->scalar();
        $this->choice_deleted_by = Yii::$app->user->id;
        return $this->save(false, ['choice_deleted_at', 'choice_status_id', 'choice_deleted_by']);
    }

    /**
     * Restore: Inaondoa thamani ya `deleted_at`.
     */
    public function restore()
    {
        $this->choice_deleted_at = null;
        $this->choice_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
        $this->choice_updated_by = Yii::$app->user->id;
        return $this->save(false, ['choice_deleted_at', 'choice_status_id', 'choice_updated_by']);
    }

    /**
     * Override `find()` ili kuchuja rekodi zilizofutwa kwa default.
     */
    public static function find()
    {
        return parent::find()->where(['choice_deleted_at' => null]);
    }

    /**
     * Methodi maalum ya kuchuja na kurudisha rekodi ambazo zimefutwa pekee.
     */
    public static function onlyDeleted()
    {
        return parent::find()->where(['not', ['choice_deleted_at' => null]]);
    }

    /**
     * Methodi maalum ya kupata rekodi pamoja na zilizofutwa.
     */
    public static function findWithDeleted()
    {
        return parent::find();
    }
}