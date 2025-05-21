<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property int $id
 * @property int $district_region_id
 * @property string $district_name
 * @property int $district_status_id
 * @property string $district_created_at
 * @property int|null $district_created_by
 * @property string $district_updated_at
 * @property int|null $district_updated_by
 * @property string|null $district_deleted_at
 * @property int|null $district_deleted_by
 *
 * @property Profile[] $profiles
 * @property Region $region
 * @property StatusLookup $statusLookup
 * @property User $user
 * @property User $user0
 * @property User $user1
 */
class District extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['district_created_by', 'district_updated_by', 'district_deleted_at', 'district_deleted_by'], 'default', 'value' => null],
            [['district_region_id', 'district_name', 'district_status_id'], 'required'],
            [['district_region_id', 'district_status_id', 'district_created_by', 'district_updated_by', 'district_deleted_by'], 'integer'],
            [['district_created_at', 'district_updated_at', 'district_deleted_at'], 'safe'],
            [['district_name'], 'string', 'max' => 255],
            [['district_region_id', 'district_name'], 'unique', 'targetAttribute' => ['district_region_id', 'district_name']],
            [['district_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['district_created_by' => 'id']],
            [['district_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['district_deleted_by' => 'id']],
            [['district_region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::class, 'targetAttribute' => ['district_region_id' => 'id']],
            [['district_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['district_status_id' => 'id']],
            [['district_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['district_updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'district_region_id' => Yii::t('app', 'District Region ID'),
            'district_name' => Yii::t('app', 'District Name'),
            'district_status_id' => Yii::t('app', 'District Status ID'),
            'district_created_at' => Yii::t('app', 'District Created At'),
            'district_created_by' => Yii::t('app', 'District Created By'),
            'district_updated_at' => Yii::t('app', 'District Updated At'),
            'district_updated_by' => Yii::t('app', 'District Updated By'),
            'district_deleted_at' => Yii::t('app', 'District Deleted At'),
            'district_deleted_by' => Yii::t('app', 'District Deleted By'),
        ];
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery|ProfileQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::class, ['profile_district_id' => 'id']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery|RegionQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::class, ['id' => 'district_region_id']);
    }

    /**
     * Gets query for [[StatusLookup]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getStatusLookup()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'district_status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'district_created_by']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'district_deleted_by']);
    }

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::class, ['id' => 'district_updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return DistrictQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DistrictQuery(get_called_class());
    }

}
