<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Publication;

/**
 * PublicationSearch represents the model behind the search form of `app\models\Publication`.
 */
class PublicationSearch extends Publication
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'publication_profile_id', 'publication_status_id', 'publication_created_by', 'publication_updated_by', 'publication_deleted_by'], 'integer'],
            [['publication_title', 'publication_publisher_name', 'publication_date_of_publication', 'publication_created_at', 'publication_updated_at', 'publication_deleted_at'], 'safe'],
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
        $query = Publication::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'publication_profile_id' => $this->publication_profile_id,
            'publication_date_of_publication' => $this->publication_date_of_publication,
            'publication_status_id' => $this->publication_status_id,
            'publication_created_at' => $this->publication_created_at,
            'publication_created_by' => $this->publication_created_by,
            'publication_updated_at' => $this->publication_updated_at,
            'publication_updated_by' => $this->publication_updated_by,
            'publication_deleted_at' => $this->publication_deleted_at,
            'publication_deleted_by' => $this->publication_deleted_by,
        ]);

        $query->andFilterWhere(['like', 'publication_title', $this->publication_title])
            ->andFilterWhere(['like', 'publication_publisher_name', $this->publication_publisher_name]);

        return $dataProvider;
    }
}
