<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Cashbox */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cashboxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashbox-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'currency',
            'balance',
            'deleted',
        ],
    ]) ?>

</div>
