<?php

namespace halumein\cashbox\models;

use yii;

/**
 * This is the model class for table "cashbox_exchange".
 *
 * @property integer $id
 * @property integer $from_cashbox_id
 * @property string $from_sum
 * @property integer $to_cashbox_id
 * @property string $to_sum
 * @property string $date
 * @property string $rate
 * @property integer $staffer_id
 * @property string $comment
 *
 * @property Cashbox $fromCashbox
 * @property Cashbox $toCashbox
 */
class Exchange extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cashbox_exchange';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_cashbox_id', 'from_sum', 'to_cashbox_id', 'to_sum', 'staffer_id'], 'required'],
            [['from_cashbox_id', 'to_cashbox_id', 'staffer_id'], 'integer'],
            [['from_sum', 'to_sum', 'rate'], 'number'],
            [['date'], 'safe'],
            [['comment'], 'string', 'max' => 255],
            [['from_cashbox_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cashbox::className(), 'targetAttribute' => ['from_cashbox_id' => 'id']],
            [['to_cashbox_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cashbox::className(), 'targetAttribute' => ['to_cashbox_id' => 'id']],
            [['deleted'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from_cashbox_id'   => 'Касса списания', //yii::t('cashbox', 'From Cashbox ID'),
            'from_sum'          => 'Сумма списания', //yii::t('cashbox', 'From Sum'),
            'to_cashbox_id'     => 'Касса приходования', //yii::t('cashbox', 'To Cashbox ID'),
            'to_sum'            => 'Сумма приходования', //yii::t('cashbox', 'To Sum'),
            'date'              => 'Дата транзакции', //yii::t('cashbox', 'Date'),
            'rate'              => 'Курс транзакции', //yii::t('cashbox', 'Rate'),
            'staffer_id'        => 'Автор транзакции', //yii::t('cashbox', 'Staffer ID'),
            'comment'           => 'Комментарий', //yii::t('cashbox', 'Comment'),
            'deleted'           => 'Удалена',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromCashbox()
    {
        return $this->hasOne(Cashbox::className(), ['id' => 'from_cashbox_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToCashbox()
    {
        return $this->hasOne(Cashbox::className(), ['id' => 'to_cashbox_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        $userForCashbox = Yii::$app->getModule('cashbox')->userForCashbox;
        return $this->hasOne($userForCashbox::className(), ['id' => 'staffer_id']);
    }

    public static function getActiveExchanges()
    {
        return Exchange::find()->where(['deleted' => null])->all();
    }

}
