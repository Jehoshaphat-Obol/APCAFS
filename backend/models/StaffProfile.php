<?php

namespace app\models;

use Yii;
use app\models\Company;
use app\models\StatusLookup;
use app\models\User;

/**
 * This is the model class for table "staff_profile".
 *
 * @property int $id
 * @property int $staff_company_id
 * @property int $staff_user_id
 * @property string $staff_first_name
 * @property string|null $staff_middle_name
 * @property string $staff_last_name
 * @property string $staff_phone_number
 * @property int $staff_status_id
 * @property string $staff_created_at
 * @property int|null $staff_created_by
 * @property string $staff_updated_at
 * @property int|null $staff_updated_by
 * @property string|null $staff_deleted_at
 * @property int|null $staff_deleted_by
 *
 * @property Company $company
 * @property StatusLookup $statusLookup
 * @property User $user
 * @property User $user0
 * @property User $user1
 * @property User $user2
 */
class StaffProfile extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%staff_profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['staff_middle_name', 'staff_created_by', 'staff_updated_by', 'staff_deleted_at', 'staff_deleted_by'], 'default', 'value' => null],
            [['staff_company_id', 'staff_user_id', 'staff_first_name', 'staff_last_name', 'staff_phone_number', 'staff_status_id'], 'required'],
            [['staff_company_id', 'staff_user_id', 'staff_status_id', 'staff_created_by', 'staff_updated_by', 'staff_deleted_by'], 'integer'],
            [['staff_created_at', 'staff_updated_at', 'staff_deleted_at'], 'safe'],
            [['staff_first_name', 'staff_middle_name', 'staff_last_name'], 'string', 'max' => 100],
            [['staff_phone_number'], 'string', 'max' => 10],
            [['staff_company_id', 'staff_user_id', 'staff_first_name', 'staff_last_name', 'staff_phone_number'], 'unique', 'targetAttribute' => ['staff_company_id', 'staff_user_id', 'staff_first_name', 'staff_last_name', 'staff_phone_number']],
            [['staff_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['staff_company_id' => 'id']],
            [['staff_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['staff_created_by' => 'id']],
            [['staff_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['staff_deleted_by' => 'id']],
            [['staff_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['staff_status_id' => 'id']],
            [['staff_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['staff_updated_by' => 'id']],
            [['staff_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['staff_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'staff_company_id' => Yii::t('app', 'Staff Company ID'),
            'staff_user_id' => Yii::t('app', 'Staff User ID'),
            'staff_first_name' => Yii::t('app', 'Staff First Name'),
            'staff_middle_name' => Yii::t('app', 'Staff Middle Name'),
            'staff_last_name' => Yii::t('app', 'Staff Last Name'),
            'staff_phone_number' => Yii::t('app', 'Staff Phone Number'),
            'staff_status_id' => Yii::t('app', 'Staff Status ID'),
            'staff_created_at' => Yii::t('app', 'Staff Created At'),
            'staff_created_by' => Yii::t('app', 'Staff Created By'),
            'staff_updated_at' => Yii::t('app', 'Staff Updated At'),
            'staff_updated_by' => Yii::t('app', 'Staff Updated By'),
            'staff_deleted_at' => Yii::t('app', 'Staff Deleted At'),
            'staff_deleted_by' => Yii::t('app', 'Staff Deleted By'),
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery|CompanyQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'staff_company_id']);
    }

    /**
     * Gets query for [[StatusLookup]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getStatusLookup()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'staff_status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'staff_created_by']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'staff_deleted_by']);
    }

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::class, ['id' => 'staff_updated_by']);
    }

    /**
     * Gets query for [[User2]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser2()
    {
        return $this->hasOne(User::class, ['id' => 'staff_user_id']);
    }

    /**
     * {@inheritdoc}
     * @return StaffProfileQuery the active query used by this AR class.
     */
    // public static function find()
    // {
    //     return new StaffProfileQuery(get_called_class());
    // }

    /**
     * Soft delete: Inaweka `deleted_at` kwa sasa.
     */
    public function softDelete()
    {
        $this->staff_created_at = date('Y-m-d H:i:s');
        $this->staff_status_id = StatusLookup::find()->where(['status_code' => 'deleted'])->select('id')->scalar();
        $this->staff_deleted_by = Yii::$app->user->id;
        return $this->save(false, ['staff_created_at', 'staff_status_id', 'staff_deleted_by']);
    }

    /**
     * Restore: Inaondoa thamani ya `deleted_at`.
     */
    public function restore()
    {
        $this->staff_created_at = null;
        $this->staff_status_id = StatusLookup::find()->where(['status_code' => 'active'])->select('id')->scalar();
        $this->staff_updated_by = Yii::$app->user->id;
        return $this->save(false, ['staff_created_at', 'staff_status_id', 'staff_updated_by']);
    }

    /**
     * Override `find()` ili kuchuja rekodi zilizofutwa kwa default.
     */
    public static function find()
    {
        return parent::find()->where(['staff_created_at' => null]);
    }

    /**
     * Methodi maalum ya kuchuja na kurudisha rekodi ambazo zimefutwa pekee.
     */
    public static function onlyDeleted()
    {
        return parent::find()->where(['not', ['staff_created_at' => null]]);
    }

    /**
     * Methodi maalum ya kupata rekodi pamoja na zilizofutwa.
     */
    public static function findWithDeleted()
    {
        return parent::find();
    }
}
