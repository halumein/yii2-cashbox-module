<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Изменить кассу: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Кассы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="cashbox-update">

    <?= $this->render('_form', [
        'model' => $model,
        'activeUsers' => $activeUsers,
    ]) ?>

</div>
