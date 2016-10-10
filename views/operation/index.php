<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use nex\datepicker\DatePicker;
use halumein\cashbox\models\Cashbox;

/* @var $this yii\web\View */
/* @var $searchModel halumein\cashbox\models\search\Operationsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if($dateStart = yii::$app->request->get('date_start')) {
    $dateStart = date('d.m.Y', strtotime($dateStart));
}

if($dateStop = yii::$app->request->get('date_stop')) {
    $dateStop = date('d.m.Y', strtotime($dateStop));
}

$this->title = 'Транзакции';
$this->params['breadcrumbs'][] = ['label' => 'Кассы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operation-index">

    <p>
        <?php echo Html::a('Провести операцию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?=yii::t('order', 'Search');?></h3>
        </div>
        <div class="panel-body">
            <form action="" class="row search">
                <input type="hidden" name="OperationSearch[name]" value="" />

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
                    <input class="form-control" type="submit" value="<?=Yii::t('order', 'Search');?>" />
                </div>
                <div class="col-md-3">
                    <a href="<?= Url::to(['/cashbox/operation/index']) ?>" /><div class="form-control text-center">Cбросить все фильтры</div></a>
                </div>
            </form>
        </div>
    </div>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            if($model->type === 'income') {
                return ['class' => 'success'];
            } elseif ($model->type === 'outcome') {
                return ['class' => 'danger'];
            }
        },
        'columns' => [
            [
                'attribute' => 'id',
                'filter' => false,
                'contentOptions' => [
                    'width' => 35
                ]
            ],
            [
                'label' => 'Тип',
                'attribute' => 'type',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'type',
                    ['income' => 'Приход', 'outcome' => 'Расход'],
                    ['class' => 'form-control', 'prompt' => 'Тип операции']
                ),
                'value' => function ($model) {
                    return ($model->type === 'income') ? 'Приход' : 'Расход';
                },
            ],
            [
                'label' => 'Заказ',
                'format' => 'raw',
                'value' => function($model) {
                    return '<a href="'. Url::to([Yii::$app->getModule('cashbox')->orderViewAction, 'id' => $model->item_id]) .'">'. $model->item_id .'</a>';
                }
            ],
            'sum',
            'balance',
            [
                'label' => 'Касса',
                'attribute' => 'cashbox_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'cashbox_id',
                    \yii\helpers\ArrayHelper::map(Cashbox::getAvailable(), 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Касса']
                ),
                'value' => 'cashbox.name',
            ],
            // 'model',
            // 'item_id',
            [
                'label' => 'Дата',
                'attribute' => 'date',
                'format' =>  ['date', 'HH:mm:ss dd.MM.YYYY'],
                'filter' => false,
            ],
            // 'client_id',
            // 'staffer_id',
            // 'comment:ntext',

            // ['class' => 'yii\grid\ActionColumn', 'template' => '{view}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 65px;']],
        ],
    ]); ?>

</div>
