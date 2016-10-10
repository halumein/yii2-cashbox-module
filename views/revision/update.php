<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\Revision */

$this->title = 'Изменить сверку: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Сверки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="revision-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'activeCashboxes' => $activeCashboxes,
    ]) ?>

</div>
