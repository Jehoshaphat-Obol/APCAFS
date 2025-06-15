<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    public $roles;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'user_created_by', 'updated_at', 'user_updated_by', 'user_deleted_by'], 'integer'],
            [['username', 'company_id', 'roles', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'verification_token', 'user_deleted_at', 'user_status_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $company_id = Yii::$app->user->identity->company_id;
        
        if(Yii::$app->user->can('super-admin'))
        {
            $query = User::find();
        } elseif (Yii::$app->user->can('company-admin'))
        {
            $query = User::find()
            ->where(['company_id' => $company_id]);
        } else
        {
            throw new \yii\web\ForbiddenHttpException();
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10, // Number of records per page
            ],
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('company')
              ->joinWith('userStatus AS status');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'user_created_by' => $this->user_created_by,
            'updated_at' => $this->updated_at,
            'user_updated_by' => $this->user_updated_by,
            'user_deleted_at' => $this->user_deleted_at,
            'user_deleted_by' => $this->user_deleted_by,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'verification_token', $this->verification_token])
            ->andFilterWhere(['like', 'company.company_name', $this->company_id])
            ->andFilterWhere(['like', 'status.status_name', $this->user_status_id]);

        // Ongeza vigezo vya kutafuta kwa roles
        if (!empty($this->roles)) {
            $usersWithRole = Yii::$app->authManager->getUserIdsByRole($this->roles);
            $query->andFilterWhere(['id' => $usersWithRole]);
        }
        return $dataProvider;
    }
}
