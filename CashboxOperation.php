<?php
namespace halumein\cashbox;

use yii\base\Component;
use halumein\cashbox\models\Cashbox;
use halumein\cashbox\models\Operation;

class CashboxOperation extends Component
{

    public function addTransaction($type, $sum, $cashbox_id, $item_id = null, $comment = '')
    {
        $model = new Operation();
        $model->type = $type;
        $model->sum = $sum;
        $model->cashbox_id = $cashbox_id;
        $model->staffer_id = \Yii::$app->user->id;
        $model->date = date('Y:m:d H:i:s');
        $model->comment = $comment;
        $model->item_id = $item_id;

        $cashBox = Cashbox::findOne($cashbox_id);

        if ($type === 'income') {
            $model->balance =  $cashBox->balance + $model->sum;
        }

        if ($type === 'outcome') {
            $model->balance = $cashBox->balance - $model->sum;
        }

        if ($model->save()) {
            $cashBox->balance = $model->balance;
            $cashBox->save();

            return [
                'status' => 'success'
            ];
        } else {
            return [
                'status' => 'error',
                'error' => $model->errors
            ];
        }
    }

}
