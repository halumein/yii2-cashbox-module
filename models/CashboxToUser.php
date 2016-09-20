<?php

namespace halumein\cashbox\models;

use Yii;

/**
 * This is the model class for table "cashbox_to_user".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $cashbox_id
 */
class CashboxToUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cashbox_to_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'cashbox_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'cashbox_id' => 'Касса',
        ];
    }
}
