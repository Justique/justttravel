<?php

namespace common\models\search;

use common\models\Tourfirms;
use common\models\TourfirmsReviews;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TourfirmsReviewsSearch represents the model behind the search form about `common\models\TourfirmsReviews`.
 */
class TourfirmsReviewsSearch extends TourfirmsReviews
{

    public $userName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'tourfirm_id', 'date_create'], 'integer'],
            [['comment', 'userName'], 'safe'],
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
        $query = TourfirmsReviews::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);
        if (Tourfirms::getTourfirmId(user()->id)) {
            $query->where(['tourfirm_id' => Tourfirms::getTourfirmId(user()->id)]);
        }
        $dataProvider->setSort([
            'attributes' => [
                'comment',
                'status',
                'date_create',
                'userName' => [
                    'asc' => ['tbl_user_profile.firstname' => SORT_ASC],
                    'desc' => ['tbl_user_profile.firstname' => SORT_DESC],
                    'label' => 'User Name'
                ],
            ],

        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['user']);
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'tourfirm_id' => $this->tourfirm_id,
            'date_create' => $this->date_create,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);
        $query->joinWith(['user' => function ($q) {
            $q->where('tbl_user_profile.firstname LIKE "%' . $this->userName . '%"');
        }]);
        return $dataProvider;
    }
}
