<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\VisaFavorites as VisaFavoritesModel;

/**
 * VisaFavorites represents the model behind the search form about `common\models\VisaFavorites`.
 */
class VisaFavorites extends VisaFavoritesModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'visa_id'], 'integer'],
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
        $query = VisaFavoritesModel::find();

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
            'visa_id' => $this->visa_id,
        ]);

        return $dataProvider;
    }
}
