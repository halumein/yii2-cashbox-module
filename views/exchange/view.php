<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Exchange */

$this->title = 'Перевод номер ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Переводы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="exchange-view">

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'from_cashbox_id',
            'from_sum',
            'to_cashbox_id',
            'to_sum',
            'date',
            'rate',
            'staffer_id',
            'comment',
            // 'deleted',
        ],
    ]) ?>

</div>
