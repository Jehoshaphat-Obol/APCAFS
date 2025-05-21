<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Language;

/**
 * LanguageSearch represents the model behind the search form of `app\models\Language`.
 */
class LanguageSearch extends Language
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'language_profile_id', 'language_status_id', 'language_created_by', 'language_updated_by', 'language_deleted_by'], 'integer'],
            [['language_name', 'language_created_at', 'language_updated_at', 'language_deleted_at'], 'safe'],
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
        $query = Language::find();

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
            'language_profile_id' => $this->language_profile_id,
            'language_status_id' => $this->language_status_id,
            'language_created_at' => $this->language_created_at,
            'language_created_by' => $this->language_created_by,
            'language_updated_at' => $this->language_updated_at,
            'language_updated_by' => $this->language_updated_by,
            'language_deleted_at' => $this->language_deleted_at,
            'language_deleted_by' => $this->language_deleted_by,
        ]);

        $query->andFilterWhere(['like', 'language_name', $this->language_name]);

        return $dataProvider;
    }
}
