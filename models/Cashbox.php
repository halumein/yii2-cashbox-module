<?php
namespace halumein\cashbox\models;

use common\models\User;
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

    public function behaviors()
    {
        return [
            [
                'class' => \voskobovich\manytomany\ManyToManyBehavior::className(),
                'relations' => [
                    'user_ids' => 'users',
                ],
            ],
        ];
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
            [['user_ids'], 'each', 'rule' => ['integer']],
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
            'user_ids' => 'Операторы кассы',
            'deleted' => 'Удалена',
        ];
    }

    public static function getActiveCashboxes()
    {
        return Cashbox::find()->where(['deleted' => null])->all();
    }

    public function getUsers()
    {
        $userModel = Yii::$app->getModule('cashbox')->userModel;
        return $this->hasMany($userModel::className(), ['id' => 'user_id'])->viaTable('cashbox_user_to_cashbox', ['cashbox_id' => 'id']);
    }

    public static function getAvailable()
    {
        $userModel = Yii::$app->getModule('cashbox')->userModel;
        return $userModel->cashboxes;
    }

}
