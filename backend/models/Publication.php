<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publication".
 *
 * @property int $id
 * @property int $publication_profile_id
 * @property string $publication_title
 * @property string $publication_publisher_name
 * @property string $publication_date_of_publication
 * @property int $publication_status_id
 * @property string $publication_created_at
 * @property int|null $publication_created_by
 * @property string $publication_updated_at
 * @property int|null $publication_updated_by
 * @property string|null $publication_deleted_at
 * @property int|null $publication_deleted_by
 *
 * @property Profile $profile
 * @property StatusLookup $statusLookup
 * @property User $user
 * @property User $user0
 * @property User $user1
 */
class Publication extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%publication}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['publication_created_by', 'publication_updated_by', 'publication_deleted_at', 'publication_deleted_by'], 'default', 'value' => null],
            [['publication_profile_id', 'publication_title', 'publication_publisher_name', 'publication_date_of_publication', 'publication_status_id'], 'required'],
            [['publication_profile_id', 'publication_status_id', 'publication_created_by', 'publication_updated_by', 'publication_deleted_by'], 'integer'],
            [['publication_date_of_publication', 'publication_created_at', 'publication_updated_at', 'publication_deleted_at'], 'safe'],
            [['publication_title', 'publication_publisher_name'], 'string', 'max' => 255],
            [['publication_profile_id', 'publication_title', 'publication_publisher_name', 'publication_date_of_publication'], 'unique', 'targetAttribute' => ['publication_profile_id', 'publication_title', 'publication_publisher_name', 'publication_date_of_publication']],
            [['publication_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['publication_created_by' => 'id']],
            [['publication_deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['publication_deleted_by' => 'id']],
            [['publication_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['publication_profile_id' => 'id']],
            [['publication_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['publication_status_id' => 'id']],
            [['publication_updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['publication_updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'publication_profile_id' => Yii::t('app', 'Publication Profile ID'),
            'publication_title' => Yii::t('app', 'Publication Title'),
            'publication_publisher_name' => Yii::t('app', 'Publication Publisher Name'),
            'publication_date_of_publication' => Yii::t('app', 'Publication Date Of Publication'),
            'publication_status_id' => Yii::t('app', 'Publication Status ID'),
            'publication_created_at' => Yii::t('app', 'Publication Created At'),
            'publication_created_by' => Yii::t('app', 'Publication Created By'),
            'publication_updated_at' => Yii::t('app', 'Publication Updated At'),
            'publication_updated_by' => Yii::t('app', 'Publication Updated By'),
            'publication_deleted_at' => Yii::t('app', 'Publication Deleted At'),
            'publication_deleted_by' => Yii::t('app', 'Publication Deleted By'),
        ];
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery|ProfileQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['id' => 'publication_profile_id']);
    }

    /**
     * Gets query for [[StatusLookup]].
     *
     * @return \yii\db\ActiveQuery|StatusLookupQuery
     */
    public function getStatusLookup()
    {
        return $this->hasOne(StatusLookup::class, ['id' => 'publication_status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'publication_created_by']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'publication_deleted_by']);
    }

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::class, ['id' => 'publication_updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return PublicationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PublicationQuery(get_called_class());
    }

}
