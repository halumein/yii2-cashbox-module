<?php

use yii\helpers\Html;


/* @var $this yii\web\View */

$this->title = 'Добавить кассу';
$this->params['breadcrumbs'][] = ['label' => 'Кассы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashbox-create">

    <?= $this->render('_form', [
        'model' => $model,
        'activeUsers' => $activeUsers,
    ]) ?>

</div>
