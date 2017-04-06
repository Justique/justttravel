<?php

namespace common\models\search;

use common\models\Visa;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * VisaSearch represents the model behind the search form about `common\models\Visa`.
 */
class VisaSearch extends Visa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'country_id', 'tour_id', 'price', 'date_create', 'date_update', 'city_id', 'registration_period', 'user_id'], 'integer'],
            [['description', 'documents', 'slug'], 'safe'],
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
    public function search($params, $flag=null)
    {

        $query = Visa::find();
        if($flag){
            $query->where(['tourfirm_id'=>$flag]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 6
            ],
            'sort'=> ['defaultOrder' => ['published_at' => SORT_DESC]]
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'country_id' => $this->country_id,
            'tour_id' => $this->tour_id,
            'price' => $this->price,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'city_id' => $this->city_id,
            'registration_period' => $this->registration_period,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'documents', $this->documents])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }

    public function searchFront($params)
    {
        $query = Visa::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>5
            ],
            'sort'=> ['defaultOrder' => ['published_at' => SORT_DESC]]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'country_id' => $this->country_id,
            'tour_id' => $this->tour_id,
            'price' => $this->price,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'city_id' => $this->city_id,
            'registration_period' => $this->registration_period,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'documents', $this->documents])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
