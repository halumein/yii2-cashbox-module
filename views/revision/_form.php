<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\Revision */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="revision-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php //echo $form->field($model, 'cashbox_id')->textInput() ?>

    <?php
    echo $form->field($model, 'cashbox_id')
        ->widget(Select2::classname(), [
            'data' => ArrayHelper::map($activeCashboxes, 'id', 'name'),
            'language' => 'ru',
            'options' => ['placeholder' => 'Выберите кассу ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?php echo $form->field($model, 'balance_fact')->textInput(['maxlength' => true, 'placeholder' => '0.00']) ?>

    <?php echo $form->field($model, 'balance_expect')->textInput(['maxlength' => true, 'placeholder' => '0.00']) ?>

    <?php //echo $form->field($model, 'date')->textInput() ?>

    <?php //echo $form->field($model, 'user_id')->textInput() ?>

    <?php echo $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
