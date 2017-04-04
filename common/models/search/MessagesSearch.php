<?php

namespace common\models\search;

use common\models\Messages;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MessagesSearch represents the model behind the search form about `common\models\Messages`.
 */
class MessagesSearch extends Messages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'from_id', 'whom_id', 'status', 'is_delete_from', 'is_delete_whom', 'created_at', 'updated_at'], 'integer'],
            [['message'], 'safe'],
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
        $query = Messages::find();



        $dataProvider = new ActiveDataProvider([
            'query' => $query,
//            'pagination' => ['pageSize'=> 10]
        ]);
        $query->where(['whom_id'=>user()->id]);
        $query->from([
        'new_table' => Messages::find()
            ->orderBy([
                'created_at' => SORT_DESC
            ])
        ]);
       $query->groupBy('from_id');
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'from_id' => $this->from_id,
            'whom_id' => $this->whom_id,
            'status' => $this->status,
            'is_delete_from' => $this->is_delete_from,
            'is_delete_whom' => $this->is_delete_whom,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
