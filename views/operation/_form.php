<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\Operation */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="operation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'type')->dropDownList([ 'income' => 'Приход', 'outcome' => 'Исход', ]) ?>

    <?php echo $form->field($model, 'status')->dropDownList([ 'created' => 'Создан', 'charged' => 'проведён', 'refunded' => 'Отменён',]) ?>

    <?php echo $form->field($model, 'sum')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'cashbox_id')->textInput() ?>

    <?php echo $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
