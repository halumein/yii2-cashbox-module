<?php

namespace halumein\cashbox\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use halumein\cashbox\models\Operation;

/**
 * Operationsearch represents the model behind the search form about `halumein\cashbox\models\Operation`.
 */
class OperationSearch extends Operation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cashbox_id', 'item_id', 'client_id', 'staffer_id', 'cancel'], 'integer'],
            [['type', 'model', 'date', 'comment'], 'safe'],
            [['balance', 'sum'], 'number'],
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
        $query = Operation::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'balance' => $this->balance,
            'sum' => $this->sum,
            'cashbox_id' => $this->cashbox_id,
            'item_id' => $this->item_id,
            'date' => $this->date,
            'client_id' => $this->client_id,
            'staffer_id' => $this->staffer_id,
            'cancel' => $this->cancel,
        ]);
        
        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        if(yii::$app->request->get('date_start') && yii::$app->request->get('date_start') == yii::$app->request->get('date_stop')) {
            $query->andWhere(['DATE_FORMAT(date, "%Y-%m-%d")' => date('Y-m-d', strtotime(yii::$app->request->get('date_start')))]);
        } else {
            if($dateStart = yii::$app->request->get('date_start')) {
                $query->andWhere('DATE_FORMAT(date, "%Y-%m-%d") >= :start', [':start' => date('Y-m-d', strtotime($dateStart))]);
            }

            if($dateStop = yii::$app->request->get('date_stop')) {
                $query->andWhere('DATE_FORMAT(date, "%Y-%m-%d") <= :stop', [':stop' => date('Y-m-d', strtotime($dateStop))]);
            }
        }

        return $dataProvider;
    }
}
