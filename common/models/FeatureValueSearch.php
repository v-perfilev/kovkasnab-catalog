<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FeatureValue;

/**
 * FeatureValueSearch represents the model behind the search form about `common\models\FeatureValue`.
 */
class FeatureValueSearch extends FeatureValue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'feature_id'], 'integer'],
            [['value'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = FeatureValue::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'feature_id' => $this->feature_id,
        ]);

        $query->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
