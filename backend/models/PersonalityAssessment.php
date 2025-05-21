<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personality_assessment".
 *
 * @property int $id
 * @property int $personality_profile_id
 * @property int $personality_IE_score
 * @property int $personality_NS_score
 * @property int $personality_TF_score
 * @property int $personality_JB_score
 * @property string $personality_last_analysis_date
 * @property int $personality_status_id
 * @property string $personality_created_at
 * @property int|null $personality_created_by
 * @property string $personality_updated_at
 * @property int|null $personality_updated_by
 * @property string|null $personality_deleted_at
 * @property int|null $personality_deleted_by
 *
 * @property Profile $profile
 * @property StatusLookup $statusLookup
 * @property User $user
 * @property User $user0
 * @property User $user1
 */
class PersonalityAssessment extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personality_assessment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['personality_created_by', 'personality_updated_by', 'personality_deleted_at', 'personality_deleted_by'], 'default', 'value' => null],
            [['personality_profile_id', 'personality_IE_score', 'personality_NS_score', 'personality_TF_score', 'personality_JB_score', 'personality_last_analysis_date', 'personality_status_id'], 'required'],
            [['personality_profile_id', 'personality_IE_score', 'personality_NS_score', 'personality_TF_score', 'personality_JB_score', 'personality_status_id', 'personality_created_by', 'personality_updated_by', 'personality_deleted_by'], 'integer'],
            [['personality_last_analysis_date', 'personality_created_at', 'personality_updated_at', 'personality_deleted_at'], 'safe'],
            [['personality_profile_id', 'personality_IE_score', 'personality_NS_score', 'personality_TF_score', 'personality_JB_score'], 'unique', 'targetAttribute' => ['personality_profile_id', 'personality_IE_score', 'personality_NS_score', 'personality_TF_score', 'personality_JB_score']],
            [['personality_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['personality_created_by' => 'id']],
            [['personality_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['personality_deleted_by' => 'id']],
            [['personality_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['personality_profile_id' => 'id']],
            [['personality_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['personality_status_id' => 'id']],
            [['personality_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['personality_updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'personality_profile_id' => Yii::t('app', 'Personality Profile ID'),
            'personality_IE_score' => Yii::t('app', 'Personality Ie Score'),
            'personality_NS_score' => Yii::t('app', 'Personality Ns Score'),
            'personality_TF_score' => Yii::t('app', 'Personality Tf Score'),
            'personality_JB_score' => Yii::t('app', 'Personality Jb Score'),
            'personality_last_analysis_date' => Yii::t('app', 'Personality Last Analysis Date'),
            'personality_status_id' => Yii::t('app', 'Personality Status ID'),
            'personality_created_at' => Yii::t('app', 'Personality Created At'),
            'personality_created_by' => Yii::t('app', 'Personality Created By'),
            'personality_updated_at' => Yii::t('app', 'Personality Updated At'),
            'personality_updated_by' => Yii::t('app', 'Personality Updated By'),
            'personality_deleted_at' => Yii::t('app', 'Personality Deleted At'),
            'personality_deleted_by' => Yii::t('app', 'Personality Deleted By'),
        ];
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery|ProfileQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['id' => 'personality_profile_id']);
    }

    /**
     * Gets query for [[StatusLookup]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getStatusLookup()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'personality_status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'personality_created_by']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'personality_deleted_by']);
    }

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::class, ['id' => 'personality_updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return PersonalityAssessmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonalityAssessmentQuery(get_called_class());
    }

}
