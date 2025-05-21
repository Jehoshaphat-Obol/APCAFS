<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "education".
 *
 * @property int $id
 * @property int $education_profile_id
 * @property string|null $education_degree_name
 * @property string $education_programme_name
 * @property string $education_university_name
 * @property string $education_graduation_date
 * @property int $education_status_id
 * @property string $education_created_at
 * @property int|null $education_created_by
 * @property string $education_updated_at
 * @property int|null $education_updated_by
 * @property string|null $education_deleted_at
 * @property int|null $education_deleted_by
 *
 * @property Profile $profile
 * @property StatusLookup $statusLookup
 * @property User $user
 * @property User $user0
 * @property User $user1
 */
class Education extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'education';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['education_degree_name', 'education_created_by', 'education_updated_by', 'education_deleted_at', 'education_deleted_by'], 'default', 'value' => null],
            [['education_profile_id', 'education_programme_name', 'education_university_name', 'education_graduation_date', 'education_status_id'], 'required'],
            [['education_profile_id', 'education_status_id', 'education_created_by', 'education_updated_by', 'education_deleted_by'], 'integer'],
            [['education_graduation_date', 'education_created_at', 'education_updated_at', 'education_deleted_at'], 'safe'],
            [['education_degree_name'], 'string', 'max' => 100],
            [['education_programme_name'], 'string', 'max' => 200],
            [['education_university_name'], 'string', 'max' => 255],
            [['education_profile_id', 'education_degree_name', 'education_programme_name', 'education_university_name'], 'unique', 'targetAttribute' => ['education_profile_id', 'education_degree_name', 'education_programme_name', 'education_university_name']],
            [['education_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['education_created_by' => 'id']],
            [['education_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['education_deleted_by' => 'id']],
            [['education_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['education_profile_id' => 'id']],
            [['education_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['education_status_id' => 'id']],
            [['education_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['education_updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'education_profile_id' => Yii::t('app', 'Education Profile ID'),
            'education_degree_name' => Yii::t('app', 'Education Degree Name'),
            'education_programme_name' => Yii::t('app', 'Education Programme Name'),
            'education_university_name' => Yii::t('app', 'Education University Name'),
            'education_graduation_date' => Yii::t('app', 'Education Graduation Date'),
            'education_status_id' => Yii::t('app', 'Education Status ID'),
            'education_created_at' => Yii::t('app', 'Education Created At'),
            'education_created_by' => Yii::t('app', 'Education Created By'),
            'education_updated_at' => Yii::t('app', 'Education Updated At'),
            'education_updated_by' => Yii::t('app', 'Education Updated By'),
            'education_deleted_at' => Yii::t('app', 'Education Deleted At'),
            'education_deleted_by' => Yii::t('app', 'Education Deleted By'),
        ];
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery|ProfileQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['id' => 'education_profile_id']);
    }

    /**
     * Gets query for [[StatusLookup]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getStatusLookup()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'education_status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'education_created_by']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'education_deleted_by']);
    }

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::class, ['id' => 'education_updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return EducationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EducationQuery(get_called_class());
    }

}
