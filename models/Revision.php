<?php

namespace halumein\cashbox\models;

use Yii;

/**
 * This is the model class for table "cashbox_revision".
 *
 * @property integer $id
 * @property integer $cashbox_id
 * @property string $balance_fact
 * @property string $balance_expect
 * @property string $date
 * @property integer $user_id
 * @property string $comment
 */
class Revision extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cashbox_revision';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cashbox_id', 'date', 'user_id', 'balance_fact'], 'required'],
            [['cashbox_id', 'user_id'], 'integer'],
            [['balance_fact', 'balance_expect'], 'number'],
            [['date'], 'safe'],
            [['comment'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cashbox_id' => 'Касса',
            'balance_fact' => 'Сумма в кассе',
            'balance_expect' => 'Сумма по оперциям',
            'date' => 'Дата',
            'user_id' => 'Пользователь',
            'comment' => 'Комментарий',
        ];
    }

    public function getCashbox()
    {
        return $this->hasOne(Cashbox::className(), ['id' => 'cashbox_id']);
    }

    public function getUser()
    {
        $userModel = Yii::$app->getModule('cashbox')->userModel;
        return $this->hasOne($userModel::className(), ['id' => 'user_id']);
    }
}
