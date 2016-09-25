<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\Revision */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Инкассации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="revision-view">

    <p>
        <?php echo Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить эту инкассацию?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cashbox_id',
            'balance_fact',
            'balance_expect',
            'date',
            'user_id',
            'comment:ntext',
        ],
    ]) ?>

</div>
