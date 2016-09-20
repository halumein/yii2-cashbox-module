<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

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

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
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
            'cashbox_id',
            // 'model',
            // 'item_id',
            [
                'label' => 'Дата',
                'attribute' => 'date',
                'filter' => ''
            ],
            // 'client_id',
            // 'staffer_id',
            // 'comment:ntext',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 65px;']],
        ],
    ]); ?>

</div>
