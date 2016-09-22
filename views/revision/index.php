<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use nex\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel halumein\cashbox\models\search\RevisionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Инкассации';
$this->params['breadcrumbs'][] = $this->title;

if($dateStart = yii::$app->request->get('date_start')) {
    $dateStart = date('d.m.Y', strtotime($dateStart));
}

if($dateStop = yii::$app->request->get('date_stop')) {
    $dateStop = date('d.m.Y', strtotime($dateStop));
}
?>
<div class="revision-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Добавить инкассацию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?=yii::t('order', 'Search');?></h3>
        </div>
        <div class="panel-body">
            <form action="" class="row search">
                <input type="hidden" name="RevisionSearch[name]" value="" />
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
            //['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'filter' => false,
                'contentOptions' => [
                    'width' => 35
                ]
            ],
            [
                'attribute' => 'cashbox_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'cashbox_id',
                    ArrayHelper::map($activeCashboxes, 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Все кассы']
                ),
                'value' => 'cashbox.name'
            ],
            [
                'attribute' => 'balance_fact',
                'filter' => false,
                'contentOptions' => [
                    'width' => 180
                ]
            ],
            [
                'attribute' => 'balance_expect',
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
                'attribute' => 'user_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'user_id',
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

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 125px;']],
        ],
    ]); ?>

</div>
