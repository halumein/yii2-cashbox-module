<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Cashbox */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Кассы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashbox-view">

    <p>
        <?php // TODO переделать на транслэйт ?>
        <?php echo Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                // TODO переделать на транслэйт
                'confirm' => 'Уверены что хотите удалить кассу?',
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
