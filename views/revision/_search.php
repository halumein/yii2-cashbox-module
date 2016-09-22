<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\search\RevisionSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="revision-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'cashbox_id') ?>

    <?php echo $form->field($model, 'balance_fact') ?>

    <?php echo $form->field($model, 'balance_expect') ?>

    <?php echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Сброс', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
