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
            [['from_cashbox_id', 'to_cashbox_id', 'date', 'staffer_id', 'comment'], 'required'],
            [['from_cashbox_id', 'to_cashbox_id', 'staffer_id'], 'integer'],
            [['from_sum', 'to_sum', 'rate'], 'number'],
            [['date'], 'safe'],
            [['comment'], 'string', 'max' => 255],
            [['from_cashbox_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cashbox::className(), 'targetAttribute' => ['from_cashbox_id' => 'id']],
            [['to_cashbox_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cashbox::className(), 'targetAttribute' => ['to_cashbox_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            //'from_cashbox_id' => yii::t('cashbox', 'From Cashbox ID'),
            'from_cashbox_id' => 'Касса списания',
            'from_sum' => yii::t('cashbox', 'From Sum'),
            'to_cashbox_id' => yii::t('cashbox', 'To Cashbox ID'),
            'to_sum' => yii::t('cashbox', 'To Sum'),
            'date' => yii::t('cashbox', 'Date'),
            'rate' => yii::t('cashbox', 'Rate'),
            'staffer_id' => yii::t('cashbox', 'Staffer ID'),
            'comment' => yii::t('cashbox', 'Comment'),
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
}
