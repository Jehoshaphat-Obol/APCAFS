<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "award".
 *
 * @property int $id
 * @property int $award_profile_id
 * @property string|null $award_title
 * @property string $award_organization_name
 * @property string $award_issue_number
 * @property string $award_date_of_issue
 * @property int $award_status_id
 * @property string $award_created_at
 * @property int|null $award_created_by
 * @property string $award_updated_at
 * @property int|null $award_updated_by
 * @property string|null $award_deleted_at
 * @property int|null $award_deleted_by
 *
 * @property Profile $profile
 * @property StatusLookup $statusLookup
 * @property User $user
 * @property User $user0
 * @property User $user1
 */
class Award extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%award}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['award_title', 'award_created_by', 'award_updated_by', 'award_deleted_at', 'award_deleted_by'], 'default', 'value' => null],
            [['award_profile_id', 'award_organization_name', 'award_issue_number', 'award_date_of_issue', 'award_status_id'], 'required'],
            [['award_profile_id', 'award_status_id', 'award_created_by', 'award_updated_by', 'award_deleted_by'], 'integer'],
            [['award_date_of_issue', 'award_created_at', 'award_updated_at', 'award_deleted_at'], 'safe'],
            [['award_title'], 'string', 'max' => 255],
            [['award_organization_name'], 'string', 'max' => 200],
            [['award_issue_number'], 'string', 'max' => 50],
            [['award_profile_id', 'award_title', 'award_organization_name', 'award_issue_number'], 'unique', 'targetAttribute' => ['award_profile_id', 'award_title', 'award_organization_name', 'award_issue_number']],
            [['award_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['award_created_by' => 'id']],
            [['award_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['award_deleted_by' => 'id']],
            [['award_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['award_profile_id' => 'id']],
            [['award_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['award_status_id' => 'id']],
            [['award_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['award_updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'award_profile_id' => Yii::t('app', 'Award Profile ID'),
            'award_title' => Yii::t('app', 'Award Title'),
            'award_organization_name' => Yii::t('app', 'Award Organization Name'),
            'award_issue_number' => Yii::t('app', 'Award Issue Number'),
            'award_date_of_issue' => Yii::t('app', 'Award Date Of Issue'),
            'award_status_id' => Yii::t('app', 'Award Status ID'),
            'award_created_at' => Yii::t('app', 'Award Created At'),
            'award_created_by' => Yii::t('app', 'Award Created By'),
            'award_updated_at' => Yii::t('app', 'Award Updated At'),
            'award_updated_by' => Yii::t('app', 'Award Updated By'),
            'award_deleted_at' => Yii::t('app', 'Award Deleted At'),
            'award_deleted_by' => Yii::t('app', 'Award Deleted By'),
        ];
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery|ProfileQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['id' => 'award_profile_id']);
    }

    /**
     * Gets query for [[StatusLookup]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getStatusLookup()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'award_status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'award_created_by']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'award_deleted_by']);
    }

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::class, ['id' => 'award_updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return AwardQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AwardQuery(get_called_class());
    }

}
