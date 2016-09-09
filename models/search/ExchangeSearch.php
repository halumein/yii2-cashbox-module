<?php

namespace halumein\cashbox\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use halumein\cashbox\models\Exchange;

/**
 * ExchangeSearch represents the model behind the search form about `app\models\Exchange`.
 */
class ExchangeSearch extends Exchange
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'from_cashbox_id', 'to_cashbox_id', 'staffer_id'], 'integer'],
            [['from_sum', 'to_sum', 'rate'], 'number'],
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
        $query = Exchange::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'from_cashbox_id' => $this->from_cashbox_id,
            'from_sum' => $this->from_sum,
            'to_cashbox_id' => $this->to_cashbox_id,
            'to_sum' => $this->to_sum,
            'date' => $this->date,
            'rate' => $this->rate,
            'staffer_id' => $this->staffer_id,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        if($dateStart = yii::$app->request->get('date_start')) {
            $dateStart = date('Y-m-d', strtotime($dateStart));
            if(!yii::$app->request->get('date_stop')) {
                $query->andWhere('DATE_FORMAT(date, "%Y-%m-%d") = :dateStart', [':dateStart' => $dateStart]);
            } else {
                $query->andWhere('date > :dateStart', [':dateStart' => $dateStart]);
            }
        }

        if($dateStop = yii::$app->request->get('date_stop')) {
            $dateStop = date('Y-m-d', strtotime($dateStop));
            if($dateStop == '0000-00-00 00:00:00') {
                $dateStop = date('Y-m-d');
            }

            $query->andWhere('date < :dateStop', [':dateStop' => $dateStop]);
        }

        return $dataProvider;
    }
}
