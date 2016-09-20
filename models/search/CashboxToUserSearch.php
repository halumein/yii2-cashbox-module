<?php

namespace halumein\cashbox\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use halumein\cashbox\models\CashboxToUser;

/**
 * CashboxToUser represents the model behind the search form about `halumein\cashbox\models\CashboxToUser`.
 */
class CashboxToUserSearch extends CashboxToUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'cashbox_id'], 'integer'],
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
        $query = CashboxToUser::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'cashbox_id' => $this->cashbox_id,
        ]);

        return $dataProvider;
    }
}
