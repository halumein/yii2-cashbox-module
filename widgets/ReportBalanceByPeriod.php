<?php
namespace halumein\cashbox\widgets;

use yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use halumein\cashbox\models\Cashbox;

class ReportBalanceByPeriod extends \yii\base\Widget
{
    public $dateStart;
    public $dateStop;

    public function init()
    {
        parent::init();
        \halumein\cashbox\assets\SelectorAsset::register($this->getView());
        return true;
    }

    public function run()
    {

        $cashboxes = Cashbox::getAvailable();

        return $this->render('reportBalanceByPeriod', [
            'cashboxes' => $cashboxes,
            'dateStart' => $this->dateStart,
            'dateStop' => $this->dateStop,
        ]);

    }
}
