<?php

namespace common\models\search;

use common\models\ToursOrder;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ToursOrderSearch represents the model behind the search form about `common\models\ToursOrder`.
 */
class ToursOrderSearch extends ToursOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'tour_id', 'created'], 'integer'],
            [['name', 'date', 'email'], 'safe'],
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
        $query = ToursOrder::find()->with('tour', 'tour.transport', 'tour.city','tour.fromCity','tour.country');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if(isset($params['Toursorder[tourfirm_id]'])){
            $query->where(['tourfirm_id'=>$params['Toursorder[tourfirm_id]']]);
        }
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'tour_id' => $this->tour_id,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
