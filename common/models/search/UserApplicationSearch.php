<?php

namespace common\models\search;

use common\models\UserApplication;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserApplicationSearch represents the model behind the search form about `common\models\UserApplication`.
 */
class UserApplicationSearch extends UserApplication
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'country_id', 'city_id', 'resort_city', 'price', 'adults', 'childrens', 'country_from_id', 'shopping_city', 'user_id', 'date_create', 'is_active'], 'integer'],
            [['date', 'comment'], 'safe'],
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
        $query = UserApplication::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5
            ]
        ]);
        if(isset($params['Applicationfortours[is_active]'])){
            $query->andWhere(['is_active'=>1]);
        }
        if(isset($params['UserApplication[user_id]'])){
            $query->andWhere(['user_id'=>user()->id]);
        }
        $this->load($params);

        if(!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'resort_city' => $this->resort_city,
            'price' => $this->price,
            'adults' => $this->adults,
            'childrens' => $this->childrens,
            'country_from_id' => $this->country_from_id,
            'shopping_city' => $this->shopping_city,
            'user_id' => $this->user_id,
            'date_create' => $this->date_create,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
