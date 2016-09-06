<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CashboxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cashboxes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashbox-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Cashbox', ['create'], ['class' => 'btn btn-success']) ?>
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
            'deleted',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
