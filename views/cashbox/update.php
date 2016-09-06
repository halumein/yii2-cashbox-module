<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cashbox */

$this->title = 'Update Cashbox: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cashboxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cashbox-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
