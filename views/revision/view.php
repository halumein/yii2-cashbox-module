<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\Revision */

$this->title = 'Просмотр инкассации';
$this->params['breadcrumbs'][] = ['label' => 'Инкассации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="revision-view">

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
