<?php

namespace common\models\search;

use common\models\ApplicationForTours;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ApplicationForToursSearch represents the model behind the search form about `common\models\ApplicationForTours`.
 */
class ApplicationForToursSearch extends ApplicationForTours
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'country_to_id', 'city_to_id', 'price', 'adults', 'childrens', 'country_from_id', 'city_from_id', 'user_application_id', 'date_create', 'date_update'], 'integer'],
            [['date'], 'safe'],
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
        $query = ApplicationForTours::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize'=>5]
        ]);
        if(isset($params['Application_id'])){
            $query->andWhere(['user_application_id'=>$params['Application_id']]);
        }
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
            'price' => $this->price,
            'adults' => $this->adults,
            'childrens' => $this->childrens,
            'country_from_id' => $this->country_from_id,
            'city_from_id' => $this->city_from_id,
            'user_application_id' => $this->user_application_id,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
        ]);

        $query->andFilterWhere(['like', 'date', $this->date]);

        return $dataProvider;
    }
}
