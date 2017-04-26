<?php

namespace common\models\search;

use common\models\Tours;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ToursSearch represents the model behind the search form about `common\models\Tours`.
 */
class ToursSearch extends Tours
{
    public $city_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'country_to_id', 'city_to_id', 'city_from_id', 'count_old', 'count_kids', 'hotel_id', 'user_id', 'created_at', 'published_at', 'city_id'], 'integer'],
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

        if(isset($params['Tours']['Price'])){
            if($params['Tours']['Price']['price_with'] && $params['Tours']['Price']['price_to']){
                $query->andFilterWhere(['between','price',$params['Tours']['Price']['price_with'], $params['Tours']['Price']['price_to']]);
//                dump($params);

            }
            elseif($params['Tours']['Price']['price_with']){
                $query->andFilterWhere(['>', 'price', $params['Tours']['Price']['price_with']]);
            }
            elseif($params['Tours']['Price']['price_to']){
                $query->andFilterWhere(['<', 'price', $params['Tours']['Price']['price_to']]);
            }
        }

        if(isset($params['Tours']['TourSearchFilter'])) {

            $arr = [];
            foreach($params['Tours']['TourSearchFilter'] as $key => $value) {
                if(!empty($value)){
                    $arr[$key] = $value;
                }
            }
            if($arr){
                $query->andFilterWhere($arr);
            }
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort'=> ['defaultOrder' => ['published_at' => SORT_DESC]]
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith(['tourfirm' => function($q) {
            $q->joinWith('touroperatorProfile');
        }]);

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
            '{{%user_profile}}.city' => $this->city_id
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'country_to_id', $this->country_to_id])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'date_from', $this->date_from])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'thumbnail_base_url', $this->thumbnail_base_url])
            ->andFilterWhere(['like', 'thumbnail_path', $this->thumbnail_path]);

        return $dataProvider;
    }
}
