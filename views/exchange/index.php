<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use halumein\cashbox\models\Cashbox;
use nex\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExchangeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Переводы';
$this->params['breadcrumbs'][] = $this->title;

if($dateStart = yii::$app->request->get('date_start')) {
    $dateStart = date('d.m.Y', strtotime($dateStart));
}

if($dateStop = yii::$app->request->get('date_stop')) {
    $dateStop = date('d.m.Y', strtotime($dateStop));
}

?>
<div class="exchange-index">

    <div class="row">
        <div class="col-sm-3">
            <p>
                <?php echo Html::a('Добавить перевод', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="col-sm-9">
                <div class="service-menu">
                    <?=$this->render('../_common/menu');?>
                </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?=yii::t('order', 'Search');?></h3>
        </div>
        <div class="panel-body">
            <form action="" class="row search">
                <input type="hidden" name="ExchangeSearch[name]" value="" />
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6">
                            <?= DatePicker::widget([
                                'name' => 'date_start',
                                'addon' => false,
                                'value' => $dateStart,
                                'size' => 'sm',
                                'language' => 'ru',
                                'placeholder' => yii::t('order', 'Date from'),
                                'clientOptions' => [
                                    'format' => 'L',
                                    'minDate' => '2015-01-01',
                                    'maxDate' => date('Y-m-d'),
                                ],
                                'dropdownItems' => [
                                    ['label' => 'Yesterday', 'url' => '#', 'value' => \Yii::$app->formatter->asDate('-1 day')],
                                    ['label' => 'Tomorrow', 'url' => '#', 'value' => \Yii::$app->formatter->asDate('+1 day')],
                                    ['label' => 'Some value', 'url' => '#', 'value' => 'Special value'],
                                ],
                            ]);?>
                        </div>
                        <div class="col-md-6">
                            <?= DatePicker::widget([
                                'name' => 'date_stop',
                                'addon' => false,
                                'value' => $dateStop,
                                'size' => 'sm',
                                'placeholder' => yii::t('order', 'Date to'),
                                'language' => 'ru',
                                'clientOptions' => [
                                    'format' => 'L',
                                    'minDate' => '2015-01-01',
                                    'maxDate' => date('Y-m-d'),
                                ],
                                'dropdownItems' => [
                                    ['label' => yii::t('order', 'Yesterday'), 'url' => '#', 'value' => \Yii::$app->formatter->asDate('-1 day')],
                                    ['label' => yii::t('order', 'Tomorrow'), 'url' => '#', 'value' => \Yii::$app->formatter->asDate('+1 day')],
                                    ['label' => yii::t('order', 'Some value'), 'url' => '#', 'value' => 'Special value'],
                                ],
                            ]);?>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <input class="form-control btn-success" type="submit" value="<?=Yii::t('order', 'Search');?>"/>
                </div>

                <div class="col-md-3">
                    <a class="btn btn-default" href="<?= Url::to(['/cashbox/exchange/index']) ?>" />Cбросить все фильтры</a>
                </div>

            </form>
        </div>
    </div>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'filter' => false,
                'contentOptions' => [
                    'width' => 35
                ]
            ],
            [
                'attribute' => 'from_cashbox_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'from_cashbox_id',
                    ArrayHelper::map($activeCashboxes, 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Все кассы']
                ),
                'value' => 'fromCashbox.name'
            ],
            [
                'attribute' => 'from_sum',
                'filter' => false,
                'contentOptions' => [
                    'width' => 180
                ]
            ],
            [
                'attribute' => 'to_cashbox_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'to_cashbox_id',
                    ArrayHelper::map($activeCashboxes, 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Все кассы']
                ),
                'value' => 'toCashbox.name'
            ],
            [
                'attribute' => 'to_sum',
                'filter' => false,
                'contentOptions' => [
                    'width' => 180
                ]
            ],
            [
                'attribute' => 'date',
                'filter' => false,
            ],
            [
                'attribute' => 'rate',
                'filter' => false,
            ],
            [
                'attribute' => 'staffer_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'staffer_id',
                    //ArrayHelper::map(User::find()->all(), 'id', 'name'),
                    ArrayHelper::map($activeUsers, 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Все сотрудники']
                ),
                'value' => 'user.fullName'
            ],
            [
                'attribute' => 'comment',
                'filter' => false,
            ],

            // ['class' => 'yii\grid\ActionColumn',  'template' => '{update} {delete}'],
        ],
    ]); ?>

</div>
