<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property int $id
 * @property string $region_name
 * @property int $region_status_id
 * @property string $region_created_at
 * @property int|null $region_created_by
 * @property string $region_updated_at
 * @property int|null $region_updated_by
 * @property string|null $region_deleted_at
 * @property int|null $region_deleted_by
 *
 * @property District[] $districts
 * @property Profile[] $profiles
 * @property StatusLookup $statusLookup
 * @property User $user
 * @property User $user0
 * @property User $user1
 */
class Region extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_created_by', 'region_updated_by', 'region_deleted_at', 'region_deleted_by'], 'default', 'value' => null],
            [['region_name', 'region_status_id'], 'required'],
            [['region_status_id', 'region_created_by', 'region_updated_by', 'region_deleted_by'], 'integer'],
            [['region_created_at', 'region_updated_at', 'region_deleted_at'], 'safe'],
            [['region_name'], 'string', 'max' => 255],
            [['region_name'], 'unique'],
            [['region_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['region_created_by' => 'id']],
            [['region_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['region_deleted_by' => 'id']],
            [['region_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['region_status_id' => 'id']],
            [['region_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['region_updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'region_name' => Yii::t('app', 'Region Name'),
            'region_status_id' => Yii::t('app', 'Region Status ID'),
            'region_created_at' => Yii::t('app', 'Region Created At'),
            'region_created_by' => Yii::t('app', 'Region Created By'),
            'region_updated_at' => Yii::t('app', 'Region Updated At'),
            'region_updated_by' => Yii::t('app', 'Region Updated By'),
            'region_deleted_at' => Yii::t('app', 'Region Deleted At'),
            'region_deleted_by' => Yii::t('app', 'Region Deleted By'),
        ];
    }

    /**
     * Gets query for [[Districts]].
     *
     * @return \yii\db\ActiveQuery|DistrictQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(District::class, ['district_region_id' => 'id']);
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery|ProfileQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::class, ['profile_region_id' => 'id']);
    }

    /**
     * Gets query for [[StatusLookup]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getStatusLookup()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'region_status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'region_created_by']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'region_deleted_by']);
    }

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::class, ['id' => 'region_updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return RegionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegionQuery(get_called_class());
    }

}
