<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
<<<<<<< HEAD
use nex\datepicker\DatePicker;

=======
use halumein\cashbox\models\Cashbox;
>>>>>>> cashbox_operation_fixes

/* @var $this yii\web\View */
/* @var $searchModel halumein\cashbox\models\search\Operationsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Операции';
$this->params['breadcrumbs'][] = ['label' => 'Кассы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operation-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                    <input class="form-control" type="submit" value="<?=Yii::t('order', 'Search');?>" class="btn btn-success" />
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
            ],            [
                'label' => 'Тип',
                'attribute' => 'type',
                'value' => function ($model) {
                    return ($model->type === 'income') ? 'Приход' : 'Расход';
                },
                'filter' => ['income' => 'Приход', 'outcome' => 'Расход'],
            ],
            [
                'label' => 'Статус',
                'attribute' => 'status',
                'value' => function ($model) {
                    switch ($model->status) {
                        case 'created' : return 'Создан';
                        case 'charged' : return 'Проведён';
                        case 'refunded' : return 'Возврат';
                    }
                },
                'filter' => ['created' => 'Создан', 'charged' => 'Проведён', 'refunded' => 'Возврат'],
            ],
            'balance',
            'sum',
            [
                'label' => 'Касса',
                'attribute' => 'cashbox_id',
                'value' => 'cashbox.name',
                'filter' => \yii\helpers\ArrayHelper::map(Cashbox::getAvailable(), 'id', 'name'),
            ],
            // 'model',
            // 'item_id',
            [
                'label' => 'Дата',
                'attribute' => 'date',
            ],
            // 'client_id',
            // 'staffer_id',
            // 'comment:ntext',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 65px;']],
        ],
    ]); ?>

</div>
