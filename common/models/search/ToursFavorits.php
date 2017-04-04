<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ToursFavorits as ToursFavoritsModel;

/**
 * ToursFavorits represents the model behind the search form about `common\models\ToursFavorits`.
 */
class ToursFavorits extends ToursFavoritsModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'tour_id'], 'integer'],
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
        $query = ToursFavoritsModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->where(['user_id'=>user()->id]);

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
        ]);

        return $dataProvider;
    }
}
