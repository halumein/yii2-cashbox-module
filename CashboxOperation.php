<?php
namespace halumein\cashbox;

use halumein\cashbox\models\Cashbox;
use halumein\cashbox\models\Operation;
use yii\base\Component;

class CashboxOperation extends Component
{

    // public function addTransaction($params)
    // {
    //     $model = new Operation();
    //     $model->load($params);
    //     $model->date = date('Y:m:d H:i:s');
    //     $model->staffer_id = \Yii::$app->user->id;
    //     $cashBox = Cashbox::findOne($model->cashbox_id);
    //
    //     if ($model->type === 'income') {
    //         $model->balance =  $cashBox->balance + $model->sum;
    //     }
    //
    //     if ($model->type === 'outcome') {
    //         $model->balance = $cashBox->balance - $model->sum;
    //     }
    //
    //     if ($model->save()) {
    //         $cashBox->balance = $model->balance;
    //         $cashBox->save();
    //
    //         return [
    //             'status' => true
    //         ];
    //     } else {
    //         return [
    //             'status' => false,
    //             'message' => $model->errors
    //         ];
    //     }
    // }

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
                'status' => false,
                'message' => $model->errors
            ];
        }
    }

}
