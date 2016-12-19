<?php
namespace halumein\cashbox\models;

use Yii;
use halumein\cashbox\models\UserToCashbox;
use yii\helpers\ArrayHelper;

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
            [['organization_id'], 'integer'],
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
            'organization_id' => 'Организация',
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

    public static function getAvailable($userId = null)
    {
        $userId = $userId ? $userId : \Yii::$app->user->id;
        $cashboxes = UserToCashbox::find()->where(['user_id' => $userId])->all();
        $cashboxIds = ArrayHelper::getColumn($cashboxes, 'cashbox_id');
        $commonCashboxes = Cashbox::find()->all();

        $cashboxes = Cashbox::find()
            ->where(['id' => $cashboxIds])
            ->orWhere(['not in', 'id', ArrayHelper::getColumn(UserToCashbox::find()->select('cashbox_id')->distinct()->all(), 'cashbox_id')]);

        if (\Yii::$app->has('organization') && $organization = \Yii::$app->get('organization')) {
            $organization = \Yii::$app->organization->get();
            if ($organization) {
                $cashboxes->andWhere(['organization_id' => $organization->id]);
            }
        }

        return $cashboxes->all();
    }

    public function getNameWithCurrentBalance()
    {
        return $this->name.' ('.$this->balance.')';
    }
}
