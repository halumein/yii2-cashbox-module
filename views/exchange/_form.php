<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use halumein\cashbox\models\Cashbox;
use kartik\select2\Select2;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\Exchange */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="exchange-form">
    <?php

        if (Yii::$app->getSession()->getFlash('error')) {
            echo  Alert::widget([
                    'options' => [
                        'class' => 'alert alert-warning',
                    ],
                    'body' => Yii::$app->getSession()->getFlash('error'),
                ]
            );
        }
   ?>

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-sm-6">
            <?php
            echo $form->field($model, 'from_cashbox_id')
            ->widget(Select2::classname(), [
                'data' => ArrayHelper::map($activeCashboxes, 'id', 'name'),
                'language' => 'ru',
                'options' => ['placeholder' => 'Выберите кассу ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-sm-6">
            <?php echo $form->field($model, 'to_cashbox_id')
                ->widget(Select2::classname(), [
                    'data' => ArrayHelper::map($activeCashboxes, 'id', 'name'),
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Выберите кассу ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?php echo $form->field($model, 'from_sum')->textInput(['maxlength' => true, 'placeholder' => '0.00']) ?>
        </div>
        <div class="col-sm-6">
            <?php echo $form->field($model, 'to_sum')->textInput(['maxlength' => true, 'placeholder' => '0.00']) ?>
        </div>
    </div>

    <?php echo $form->field($model, 'rate')->textInput(['maxlength' => true, 'placeholder' => '0.00']) ?>

    <?php echo $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
