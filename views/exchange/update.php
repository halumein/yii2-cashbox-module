<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Exchange */

$this->title = 'Изменить перевод: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Exchanges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="exchange-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
