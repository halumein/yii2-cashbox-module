<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CashboxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Кассы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashbox-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Добавить кассу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'currency',
            'balance',
            // 'deleted',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 125px;']],
        ],
    ]); ?>

</div>
