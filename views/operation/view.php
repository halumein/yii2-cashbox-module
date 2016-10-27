<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\Operation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Кассы', 'url' => ['/cashbox/cashbox/index']];
$this->params['breadcrumbs'][] = ['label' => 'Операции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operation-view">

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'balance',
            'sum',
            'cashbox_id',
            // 'model',
            'item_id',
            'date',
            // 'client_id',
            'staffer_id',
            'comment:ntext',
        ],
    ]) ?>

</div>
