<?php
namespace halumein\cashbox\models;

use Yii;

/**
 * This is the model class for table "{{%cashbox_operation}}".
 *
 * @property integer $id
 * @property string $type
 * @property string $balance
 * @property string $sum
 * @property integer $cashbox_id
 * @property string $model
 * @property integer $item_id
 * @property string $date
 * @property integer $client_id
 * @property integer $staffer_id
 * @property string $comment
 */
class Operation extends \yii\db\ActiveRecord
{

    public $itemCost;
    public $paymentTypeId;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cashbox_operation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'balance', 'sum', 'cashbox_id', 'date', 'staffer_id'], 'required'],
            [['type', 'comment'], 'string'],
            [['balance', 'sum'], 'number'],
            [['cashbox_id', 'item_id', 'client_id', 'staffer_id', 'cancel'], 'integer'],
            [['date'], 'safe'],
            [['model'], 'string', 'max' => 255],
            [['cashbox_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cashbox::className(), 'targetAttribute' => ['cashbox_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип',
            'balance' => 'Баланс',
            'sum' => 'Сумма',
            'cashbox_id' => 'Касса',
            'model' => 'Модель',
            'item_id' => 'ID объекта',
            'date' => 'Дата',
            'client_id' => 'ID клиента',
            'staffer_id' => 'ID работника',
            'comment' => 'Комментарий',
            'cancel' => 'Отменен',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCashbox()
    {
        return $this->hasOne(Cashbox::className(), ['id' => 'cashbox_id']);
    }

    public function setDate()
    {
         $this->date = date('Y:m:d H:i:s');
    }

    public function setStafferId()
    {
          $this->staffer_id = \Yii::$app->user->id;
    }

    public static function getIncomeSumByPeriod($dateStart, $dateStop = null, $cashboxId = null)
    {
        $query = Operation::find();
        $query->where(['type' => 'income', 'cancel' => 0]);
        
        $query->andWhere('DATE_FORMAT(date, "%Y-%m-%d") >= :start', [':start' => date('Y-m-d', strtotime($dateStart))]);
        $query->andWhere('DATE_FORMAT(date, "%Y-%m-%d") <= :stop', [':stop' => date('Y-m-d', strtotime($dateStop))]);
        
        if ($cashboxId) {
            $query->andWhere(['cashbox_id' => $cashboxId]);
        }
        return $query->sum('sum');
    }

    public static function getOutcomeSumByPeriod($dateStart, $dateStop = null, $cashboxId = null)
    {
        $query = Operation::find();
        $query->where(['type' => 'outcome', 'cancel' => 0]);
        
        $query->andWhere('DATE_FORMAT(date, "%Y-%m-%d") >= :start', [':start' => date('Y-m-d', strtotime($dateStart))]);
        $query->andWhere('DATE_FORMAT(date, "%Y-%m-%d") <= :stop', [':stop' => date('Y-m-d', strtotime($dateStop))]);
        
        if ($cashboxId) {
            $query->andWhere(['cashbox_id' => $cashboxId]);
        }
        return $query->sum('sum');
    }

}
