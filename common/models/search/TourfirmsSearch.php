<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tourfirms;

/**
 * TourfirmsSearch represents the model behind the search form about `common\models\Tourfirms`.
 */
class TourfirmsSearch extends Tourfirms
{
    public $city_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rating', 'city_id'], 'integer'],
            [['description', 'address', 'name', 'phone', 'slug'], 'safe'],
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
        $query = Tourfirms::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('touroperatorProfile');

        $query->andFilterWhere([
            'id' => $this->id,
            'rating' => $this->rating,
            'city' => $this->city_id
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
