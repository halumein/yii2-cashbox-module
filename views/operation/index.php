<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
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

$this->title = 'Операции';
$this->params['breadcrumbs'][] = ['label' => 'Кассы', 'url' => ['cashbox/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operation-index">

    <div class="row">
        <div class="col-sm-3">
            <p>
                <?php echo Html::a('Провести операцию', ['create'], ['class' => 'btn btn-success']) ?>
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
                    <input class="form-control btn-success" type="submit" value="<?=Yii::t('order', 'Search');?>" />
                </div>
                <div class="col-md-3">
                    <a class="btn btn-default" href="<?= Url::to(['/cashbox/operation/index']) ?>" />Cбросить все фильтры</a>
                </div>
            </form>
        </div>
    </div>

    <?php

        // $totalSum = 0;
        // $dataProviderClone = clone $dataProvider;
        // if (count($dataProviderClone->getModels()) > 0) {
        //     foreach ($dataProviderClone->getModels() as $key => $model) {
        //         if ($model->type = 'income') {
        //             $totalSum += $model->sum;
        //         } else {
        //             $totalSum -= $model->sum;
        //         }
        //     }
        // }
        // unset($dataProviderClone);

        echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table'],
        'showFooter' => true,
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

                    if (!is_null(Yii::$app->getModule('cashbox')->linksToViews)) {
                        $array = Yii::$app->getModule('cashbox')->linksToViews;
                        if (isset($array[$model->model])) {
                            return '<a href="'. Url::to([$array[$model->model]['viewUrl'], $array[$model->model]['itemIdField']  => $model->item_id]) .'">'. $model->item_id .'</a>';
                        } else {
                            return $model->item_id;
                        }
                    } else {
                        return $model->item_id;
                    }
                }
            ],
            [
                'attribute' => 'sum',
                // 'footer' => $totalSum,
            ],
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
                //'format' =>  ['date', 'HH:mm:ss dd.MM.YYYY'],
                'filter' => false,
            ],
            // 'client_id',
            // 'staffer_id',
            'comment:ntext',

            // ['class' => 'yii\grid\ActionColumn', 'template' => '{view}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 65px;']],
        ],
    ]); ?>

</div>
