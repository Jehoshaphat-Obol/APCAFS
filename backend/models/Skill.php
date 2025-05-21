<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "skill".
 *
 * @property int $id
 * @property int $skill_profile_id
 * @property string|null $skill_type
 * @property string $skill_name
 * @property int $skill_status_id
 * @property string $skill_created_at
 * @property int|null $skill_created_by
 * @property string $skill_updated_at
 * @property int|null $skill_updated_by
 * @property string|null $skill_deleted_at
 * @property int|null $skill_deleted_by
 *
 * @property Profile $profile
 * @property StatusLookup $statusLookup
 * @property User $user
 * @property User $user0
 * @property User $user1
 */
class Skill extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'skill';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['skill_type', 'skill_created_by', 'skill_updated_by', 'skill_deleted_at', 'skill_deleted_by'], 'default', 'value' => null],
            [['skill_profile_id', 'skill_name', 'skill_status_id'], 'required'],
            [['skill_profile_id', 'skill_status_id', 'skill_created_by', 'skill_updated_by', 'skill_deleted_by'], 'integer'],
            [['skill_created_at', 'skill_updated_at', 'skill_deleted_at'], 'safe'],
            [['skill_type'], 'string', 'max' => 100],
            [['skill_name'], 'string', 'max' => 200],
            [['skill_profile_id', 'skill_type', 'skill_name'], 'unique', 'targetAttribute' => ['skill_profile_id', 'skill_type', 'skill_name']],
            [['skill_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['skill_created_by' => 'id']],
            [['skill_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['skill_deleted_by' => 'id']],
            [['skill_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['skill_profile_id' => 'id']],
            [['skill_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['skill_status_id' => 'id']],
            [['skill_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['skill_updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'skill_profile_id' => Yii::t('app', 'Skill Profile ID'),
            'skill_type' => Yii::t('app', 'Skill Type'),
            'skill_name' => Yii::t('app', 'Skill Name'),
            'skill_status_id' => Yii::t('app', 'Skill Status ID'),
            'skill_created_at' => Yii::t('app', 'Skill Created At'),
            'skill_created_by' => Yii::t('app', 'Skill Created By'),
            'skill_updated_at' => Yii::t('app', 'Skill Updated At'),
            'skill_updated_by' => Yii::t('app', 'Skill Updated By'),
            'skill_deleted_at' => Yii::t('app', 'Skill Deleted At'),
            'skill_deleted_by' => Yii::t('app', 'Skill Deleted By'),
        ];
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery|ProfileQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['id' => 'skill_profile_id']);
    }

    /**
     * Gets query for [[StatusLookup]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getStatusLookup()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'skill_status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'skill_created_by']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'skill_deleted_by']);
    }

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::class, ['id' => 'skill_updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return SkillQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SkillQuery(get_called_class());
    }

}
