<?php

namespace halumein\cashbox\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use halumein\cashbox\models\Revision;

/**
 * RevisionSearch represents the model behind the search form about `halumein\cashbox\models\Revision`.
 */
class RevisionSearch extends Revision
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cashbox_id', 'user_id'], 'integer'],
            [['balance_fact', 'balance_expect'], 'number'],
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
        $query = Revision::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'cashbox_id' => $this->cashbox_id,
            'balance_fact' => $this->balance_fact,
            'balance_expect' => $this->balance_expect,
            'date' => $this->date,
            'user_id' => $this->user_id,
        ]);
        
        $query->andFilterWhere(['like', 'comment', $this->comment]);

        if($dateStart = yii::$app->request->get('date_start')) {
            $dateStart = date('Y-m-d', strtotime($dateStart));
            $query->andWhere('date >= :dateStart', [':dateStart' => $dateStart]);
        }

        if($dateStop = yii::$app->request->get('date_stop')) {
            $dateStop = date('Y-m-d H:i:s', strtotime($dateStop)+86399);
            $query->andWhere('date <= :dateStop', [':dateStop' => $dateStop]);
        }

        return $dataProvider;
    }
}
