<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\Operation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Операции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operation-view">

    <p>
        <?php echo Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'balance',
            'sum',
            'cashbox_id',
            'model',
            'item_id',
            'date',
            'client_id',
            'staffer_id',
            'comment:ntext',
            'status'
        ],
    ]) ?>

</div>