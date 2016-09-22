<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel halumein\cashbox\models\search\RevisionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Инкассации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="revision-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Добавить инкассацию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
