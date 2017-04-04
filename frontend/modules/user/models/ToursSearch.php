<?php

namespace frontend\modules\user\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tours;

/**
 * ToursSearch represents the model behind the search form about `\common\models\Tours`.
 */
class ToursSearch extends Tours
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'country_to_id', 'city_to_id', 'city_from_id', 'count_old', 'count_kids', 'hotel_id', 'user_id', 'created_at', 'published_at'], 'integer'],
            [['title', 'slug', 'status', 'price', 'date_from', 'body', 'thumbnail_base_url', 'thumbnail_path'], 'safe'],
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
        $query = Tours::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'country_to_id' => $this->country_to_id,
            'city_to_id' => $this->city_to_id,
            'city_from_id' => $this->city_from_id,
            'count_old' => $this->count_old,
            'count_kids' => $this->count_kids,
            'hotel_id' => $this->hotel_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'published_at' => $this->published_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'date_from', $this->date_from])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'thumbnail_base_url', $this->thumbnail_base_url])
            ->andFilterWhere(['like', 'thumbnail_path', $this->thumbnail_path]);

        return $dataProvider;
    }
}
