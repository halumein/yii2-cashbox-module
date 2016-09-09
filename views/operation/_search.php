<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\search\Operationsearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="operation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'type') ?>

    <?php echo $form->field($model, 'balance') ?>

    <?php echo $form->field($model, 'sum') ?>

    <?php echo $form->field($model, 'cashbox_id') ?>

    <?php // echo $form->field($model, 'model') ?>

    <?php // echo $form->field($model, 'item_id') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'client_id') ?>

    <?php // echo $form->field($model, 'staffer_id') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
