<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Skill;

/**
 * SkillSearch represents the model behind the search form of `app\models\Skill`.
 */
class SkillSearch extends Skill
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'skill_profile_id', 'skill_status_id', 'skill_created_by', 'skill_updated_by', 'skill_deleted_by'], 'integer'],
            [['skill_type', 'skill_name', 'skill_created_at', 'skill_updated_at', 'skill_deleted_at'], 'safe'],
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
        $query = Skill::find();

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
            'skill_profile_id' => $this->skill_profile_id,
            'skill_status_id' => $this->skill_status_id,
            'skill_created_at' => $this->skill_created_at,
            'skill_created_by' => $this->skill_created_by,
            'skill_updated_at' => $this->skill_updated_at,
            'skill_updated_by' => $this->skill_updated_by,
            'skill_deleted_at' => $this->skill_deleted_at,
            'skill_deleted_by' => $this->skill_deleted_by,
        ]);

        $query->andFilterWhere(['like', 'skill_type', $this->skill_type])
            ->andFilterWhere(['like', 'skill_name', $this->skill_name]);

        return $dataProvider;
    }
}
