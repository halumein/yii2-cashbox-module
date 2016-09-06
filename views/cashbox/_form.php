<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Cashbox */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="cashbox-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->errorSummary($model); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <?php echo Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
