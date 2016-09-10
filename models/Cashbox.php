<?php
namespace halumein\cashbox\models;

use Yii;

/**
 * This is the model class for table "cashbox_cashbox".
 *
 * @property integer $id
 * @property string $name
 * @property string $currency
 * @property string $balance
 * @property string $deleted
 */
class Cashbox extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cashbox_cashbox';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['balance'], 'number'],
            [['deleted'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['currency'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя кассы',
            'currency' => 'Валюта',
            'balance' => 'Баланс',
            'deleted' => 'Удалена',
        ];
    }

    public static function getActiveCashboxes()
    {
        return Cashbox::find()->where(['deleted' => null])->all();
    }
}
