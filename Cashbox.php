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
    public function addTransaction($type, $sum, $cashboxId, $params = [])
    {
        $model = new Operation();
        $model->type = $type;
        $model->sum = $sum;
        $model->cashbox_id = $cashboxId;
        $model->staffer_id = \Yii::$app->user->id;
        $model->date = date('Y:m:d H:i:s');
        $model->comment = '';
        $model->item_id = null;
        $model->model = null;

        if (isset($params['itemId'])) {
            $model->item_id = $params['itemId'];
        }

        if (isset($params['model'])) {
            $model->model = $params['model'];
        }

        if (isset($params['comment'])) {
            $model->comment = $params['comment'];
        }


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
    */
    public function getIncomeSumByPeriod($dateStart, $dateStop = null, $cashboxId = null)
    {
        return Operation::getIncomeSumByPeriod($dateStart, $dateStop, $cashboxId);
    }

    /**
    *   Получить общую сумму расходов по всем кассам
    */
    public function getOutcomeSumByPeriod($dateStart, $dateStop = null)
    {
        return Operation::getOutcomeSumByPeriod($dateStart, $dateStop);
    }

    /**
    * Отменяет все транзакции по ордеру
    *  @property integer $orderId - id заказа
    */
    public function rollbackOrderPayment($orderId)
    {
        $operations = Operation::find()->where(['item_id' => $orderId])->all();

        if ($operations) {
            foreach ($operations as $key => $transaction) {
                $params = [];
                $params['comment'] = 'Отмена заказа '.$orderId;
                $params['itemId'] = $transaction->item_id;
                $this->addTransaction('outcome', $transaction->sum, $transaction->cashbox_id, $params);
            }
        }
        return true;
    }
   
    /**
    *   Баланс кассы
    */
    public function getBalance($cashboxId = null)
    {
        return Cashbox::findOne($cashboxId)->balance;
    }
   
    /**
    *   Баланс в указанное время
    */
    public function getBalanceByDate($date, $cashboxId = null)
    {
        $lastOperation = Operation::find()
            ->where('date < :date AND cashbox_id = :cashboxId', [':date' => $date, ':cashboxId' => $cashboxId])
            ->limit(1)
            ->orderBy('id DESC')
            ->one();

        if($lastOperation) {
            return $lastOperation->balance;
        }
        
        return false;
    }
}
