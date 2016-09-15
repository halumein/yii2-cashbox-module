<?php
namespace halumein\cashbox\widgets;

use yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use halumein\cashbox\models\Cashbox;

class UserCashboxSelector extends \yii\base\Widget
{
    public $actionUrl = null;

    public function init()
    {

        if ($this->actionUrl === null) {
            $this->actionUrl = '/cashbox/tools/setUserCashbox';
        }

        parent::init();

        \halumein\cashbox\assets\SelectorAsset::register($this->getView());

        return true;
    }

    public function run()
    {
        $currentCashboxModel = null;
        $userModel = Yii::$app->getModule('cashbox')->userModel;

        $currentCashboxModel = Cashbox::findOne($userModel->defaultCashbox);
        $cashboxName = $currentCashboxModel ? $currentCashboxModel->name : 'не выбрана';

        $cashboxList = Html::ul(
            ArrayHelper::map(Cashbox::getAvailable(), 'id', 'name'),
            [
                'class' => 'cashbox-list-group',
                'tag' => 'div',
                'item' => function ($item, $index) {
                    return '<div class="cashbox-list-group-item cashbox-choice-item" data-cashbox-id=' . $index . ' data-url="' . Url::to(['/cashbox/tools/set-user-default-cashbox']) .'" data-name="' . $item . '">' . $item .'</div>';
                }
            ]
        );

        return $this->render('cashboxSelector', [
            'cashboxName' => $cashboxName,
            'cashboxList' => $cashboxList
        ]);



    }
}
