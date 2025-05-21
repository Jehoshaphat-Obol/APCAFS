<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "phone_number".
 *
 * @property int $id
 * @property int $phone_profile_id
 * @property string $phone_number
 * @property int $phone_status_id
 * @property string $phone_created_at
 * @property int|null $phone_created_by
 * @property string $phone_updated_at
 * @property int|null $phone_updated_by
 * @property string|null $phone_deleted_at
 * @property int|null $phone_deleted_by
 *
 * @property Profile $profile
 * @property StatusLookup $statusLookup
 * @property User $user
 * @property User $user0
 * @property User $user1
 */
class PhoneNumber extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'phone_number';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone_created_by', 'phone_updated_by', 'phone_deleted_at', 'phone_deleted_by'], 'default', 'value' => null],
            [['phone_profile_id', 'phone_number', 'phone_status_id'], 'required'],
            [['phone_profile_id', 'phone_status_id', 'phone_created_by', 'phone_updated_by', 'phone_deleted_by'], 'integer'],
            [['phone_created_at', 'phone_updated_at', 'phone_deleted_at'], 'safe'],
            [['phone_number'], 'string', 'max' => 10],
            [['phone_profile_id', 'phone_number'], 'unique', 'targetAttribute' => ['phone_profile_id', 'phone_number']],
            [['phone_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['phone_created_by' => 'id']],
            [['phone_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['phone_deleted_by' => 'id']],
            [['phone_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['phone_profile_id' => 'id']],
            [['phone_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['phone_status_id' => 'id']],
            [['phone_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['phone_updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'phone_profile_id' => Yii::t('app', 'Phone Profile ID'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'phone_status_id' => Yii::t('app', 'Phone Status ID'),
            'phone_created_at' => Yii::t('app', 'Phone Created At'),
            'phone_created_by' => Yii::t('app', 'Phone Created By'),
            'phone_updated_at' => Yii::t('app', 'Phone Updated At'),
            'phone_updated_by' => Yii::t('app', 'Phone Updated By'),
            'phone_deleted_at' => Yii::t('app', 'Phone Deleted At'),
            'phone_deleted_by' => Yii::t('app', 'Phone Deleted By'),
        ];
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery|ProfileQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['id' => 'phone_profile_id']);
    }

    /**
     * Gets query for [[StatusLookup]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getStatusLookup()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'phone_status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'phone_created_by']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'phone_deleted_by']);
    }

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::class, ['id' => 'phone_updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return PhoneNumberQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PhoneNumberQuery(get_called_class());
    }

}
