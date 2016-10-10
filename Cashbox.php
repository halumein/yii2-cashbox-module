<?php
namespace halumein\cashbox;

use yii\base\Component;
use yii\helpers\ArrayHelper;
use halumein\cashbox\models\Cashbox as CashboxModel;
use halumein\cashbox\models\search\CashboxSearch;
use halumein\cashbox\models\UserToCashbox;
use halumein\cashbox\models\Operation;

class Cashbox extends Component
{
    /**
    *  Добавить транзакцию
    *  @property string $type - income / outcome
    *  @property float $sum - сумма
    *  @property integer $cashboxId - id кассы
    *  @property intger $itemId - id заказа/товара/услуги
    *  @property string $comment - комментарий
    */
    public function addTransaction($type, $sum, $cashboxId, $itemId = null, $comment = '')
    {
        $model = new Operation();
        $model->type = $type;
        $model->sum = $sum;
        $model->cashbox_id = $cashboxId;
        $model->staffer_id = \Yii::$app->user->id;
        $model->date = date('Y:m:d H:i:s');
        $model->comment = $comment;
        $model->item_id = $itemId;

        $cashBox = CashboxModel::findOne($cashboxId);

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

    /**
    *   Получить доступные пользователю кассы
    *  @property integer $userId - id пользователя
    */
    public function getAvailableCashbox($userId = null)
    {
        return CashboxModel::getAvailable($userId);
    }

    /**
    *   Получить общую сумму поступлений по всем кассам
    *  @property integer $userId - id пользователя
    */
    public function getIncomeSumByPeriod($dateStart, $dateStop = null)
    {
        return Operation::getIncomeSumByPeriod($dateStart, $dateStop);
    }

    /**
    *   Получить общую сумму расходов по всем кассам
    *  @property integer $userId - id пользователя
    */
    public function getOutcomeSumByPeriod($dateStart, $dateStop = null)
    {
        return Operation::getOutcomeSumByPeriod($dateStart, $dateStop);
    }

    /**
    * Отменят все транзакции по ордеру
    *  @property integer $orderId - id заказа
    */
    public function rollbackOrderPayment($orderId)
    {
        $operations = Operation::find()->where(['item_id' => $orderId])->all();

        if ($operations) {
            foreach ($operations as $key => $transaction) {
                $this->addTransaction('outcome', $transaction->sum, $transaction->cashbox_id, $transaction->item_id, 'Отмена заказа '.$orderId);
            }
        }
        return true;
    }

}
