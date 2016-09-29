<?php

namespace halumein\cashbox\models;

use Yii;

/**
 * This is the model class for table "cashbox_user_to_cashbox".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $cashbox_id
 */
class UserToCashbox extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cashbox_user_to_cashbox';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'cashbox_id'], 'required'],
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
            'user_id' => 'User ID',
            'cashbox_id' => 'Cashbox ID',
        ];
    }
}
