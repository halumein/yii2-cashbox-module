<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\Operation */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="operation-form">

    <?php $form = ActiveForm::begin([
//        'action' => \yii\helpers\Url::to(['/cashbox/operation/add-transaction'])
    ]); ?>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->errorSummary($model); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-5">
            <?= $form->field($model, 'type')->dropDownList(['income' => 'Приход', 'outcome' => 'Расход'], ['options' => [ 'income' => ['selected ' => true]]]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-5">
            <?= $form->field($model, 'sum')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-5 col-sm-offset-1">
            <?= $form->field($model, 'cashbox_id')->dropDownList(\yii\helpers\ArrayHelper::map(\halumein\cashbox\models\Cashbox::getAvailable(), 'id', 'name')) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-11">
            <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-11">
            <div class="form-group">
                <?= Html::submitButton('Провести', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
