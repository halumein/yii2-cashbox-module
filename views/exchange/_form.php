<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\Exchange */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="exchange-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'from_cashbox_id')->textInput() ?>

    <?php echo $form->field($model, 'from_sum')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'to_cashbox_id')->textInput() ?>

    <?php echo $form->field($model, 'to_sum')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'date')->textInput() ?>

    <?php echo $form->field($model, 'rate')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'staffer_id')->textInput() ?>

    <?php echo $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
