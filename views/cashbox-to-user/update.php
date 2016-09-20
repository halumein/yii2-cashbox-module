<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\CashboxToUser */

$this->title = 'Update Cashbox To User: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cashbox To Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cashbox-to-user-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
