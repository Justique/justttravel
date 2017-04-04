<?php

namespace common\models\search;

use common\models\VisaOrder;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * VisaOrderSearch represents the model behind the search form about `common\models\VisaOrder`.
 */
class VisaOrderSearch extends VisaOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'visa_id', 'created'], 'integer'],
            [['user_id', 'name', 'email'], 'safe'],
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
        $query = VisaOrder::find()->with('visa', 'visa.city','visa.country');;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if(isset($params['Visaorder[tourfirm_id]'])){
            $query->where(['tourfirm_id'=>$params['Visaorder[tourfirm_id]']]);
        }
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'visa_id' => $this->visa_id,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
