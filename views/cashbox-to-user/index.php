<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel halumein\cashbox\models\search\CashboxToUser */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cashbox To Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashbox-to-user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Cashbox To User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'cashbox_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
