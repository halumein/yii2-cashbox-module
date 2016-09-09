<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\Operation */

$this->title = 'Изменить операцию: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Операции', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="operation-update">
    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
