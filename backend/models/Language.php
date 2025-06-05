<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "language".
 *
 * @property int $id
 * @property int $language_profile_id
 * @property string $language_name
 * @property int $language_status_id
 * @property string $language_created_at
 * @property int|null $language_created_by
 * @property string $language_updated_at
 * @property int|null $language_updated_by
 * @property string|null $language_deleted_at
 * @property int|null $language_deleted_by
 *
 * @property Profile $profile
 * @property StatusLookup $statusLookup
 * @property User $user
 * @property User $user0
 * @property User $user1
 */
class Language extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%language}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['language_created_by', 'language_updated_by', 'language_deleted_at', 'language_deleted_by'], 'default', 'value' => null],
            [['language_profile_id', 'language_name', 'language_status_id'], 'required'],
            [['language_profile_id', 'language_status_id', 'language_created_by', 'language_updated_by', 'language_deleted_by'], 'integer'],
            [['language_created_at', 'language_updated_at', 'language_deleted_at'], 'safe'],
            [['language_name'], 'string', 'max' => 255],
            [['language_profile_id', 'language_name'], 'unique', 'targetAttribute' => ['language_profile_id', 'language_name']],
            [['language_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['language_created_by' => 'id']],
            [['language_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['language_deleted_by' => 'id']],
            [['language_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['language_profile_id' => 'id']],
            [['language_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['language_status_id' => 'id']],
            [['language_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['language_updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'language_profile_id' => Yii::t('app', 'Language Profile ID'),
            'language_name' => Yii::t('app', 'Language Name'),
            'language_status_id' => Yii::t('app', 'Language Status ID'),
            'language_created_at' => Yii::t('app', 'Language Created At'),
            'language_created_by' => Yii::t('app', 'Language Created By'),
            'language_updated_at' => Yii::t('app', 'Language Updated At'),
            'language_updated_by' => Yii::t('app', 'Language Updated By'),
            'language_deleted_at' => Yii::t('app', 'Language Deleted At'),
            'language_deleted_by' => Yii::t('app', 'Language Deleted By'),
        ];
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery|ProfileQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['id' => 'language_profile_id']);
    }

    /**
     * Gets query for [[StatusLookup]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getStatusLookup()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'language_status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'language_created_by']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'language_deleted_by']);
    }

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::class, ['id' => 'language_updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return LanguageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LanguageQuery(get_called_class());
    }

}
