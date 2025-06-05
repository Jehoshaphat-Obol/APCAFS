<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work_experience".
 *
 * @property int $id
 * @property int $experience_profile_id
 * @property string|null $experience_job_title
 * @property string $experience_company_name
 * @property string $experience_from
 * @property string|null $experience_to
 * @property int $experience_status_id
 * @property string $experience_created_at
 * @property int|null $experience_created_by
 * @property string $experience_updated_at
 * @property int|null $experience_updated_by
 * @property string|null $experience_deleted_at
 * @property int|null $experience_deleted_by
 *
 * @property Profile $profile
 * @property StatusLookup $statusLookup
 * @property User $user
 * @property User $user0
 * @property User $user1
 */
class WorkExperience extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%work_experience}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['experience_job_title', 'experience_to', 'experience_created_by', 'experience_updated_by', 'experience_deleted_at', 'experience_deleted_by'], 'default', 'value' => null],
            [['experience_profile_id', 'experience_company_name', 'experience_from', 'experience_status_id'], 'required'],
            [['experience_profile_id', 'experience_status_id', 'experience_created_by', 'experience_updated_by', 'experience_deleted_by'], 'integer'],
            [['experience_from', 'experience_to', 'experience_created_at', 'experience_updated_at', 'experience_deleted_at'], 'safe'],
            [['experience_job_title'], 'string', 'max' => 100],
            [['experience_company_name'], 'string', 'max' => 150],
            [['experience_profile_id', 'experience_job_title', 'experience_company_name', 'experience_from', 'experience_to'], 'unique', 'targetAttribute' => ['experience_profile_id', 'experience_job_title', 'experience_company_name', 'experience_from', 'experience_to']],
            [['experience_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['experience_created_by' => 'id']],
            [['experience_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['experience_deleted_by' => 'id']],
            [['experience_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['experience_profile_id' => 'id']],
            [['experience_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['experience_status_id' => 'id']],
            [['experience_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['experience_updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'experience_profile_id' => Yii::t('app', 'Experience Profile ID'),
            'experience_job_title' => Yii::t('app', 'Experience Job Title'),
            'experience_company_name' => Yii::t('app', 'Experience Company Name'),
            'experience_from' => Yii::t('app', 'Experience From'),
            'experience_to' => Yii::t('app', 'Experience To'),
            'experience_status_id' => Yii::t('app', 'Experience Status ID'),
            'experience_created_at' => Yii::t('app', 'Experience Created At'),
            'experience_created_by' => Yii::t('app', 'Experience Created By'),
            'experience_updated_at' => Yii::t('app', 'Experience Updated At'),
            'experience_updated_by' => Yii::t('app', 'Experience Updated By'),
            'experience_deleted_at' => Yii::t('app', 'Experience Deleted At'),
            'experience_deleted_by' => Yii::t('app', 'Experience Deleted By'),
        ];
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery|ProfileQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['id' => 'experience_profile_id']);
    }

    /**
     * Gets query for [[StatusLookup]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getStatusLookup()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'experience_status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'experience_created_by']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'experience_deleted_by']);
    }

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::class, ['id' => 'experience_updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return WorkExperienceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WorkExperienceQuery(get_called_class());
    }

}
