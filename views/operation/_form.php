<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\Operation */
/* @var $form yii\bootstrap\ActiveForm */

$cashboxModels = Yii::$app->cashbox->getAvailableCashbox();
$cashboxes = [];

foreach($cashboxModels as $cm) {
    $cashboxes[$cm->id] = "{$cm->name} ({$cm->balance})";
}
?>

<div class="operation-form">

    <?php $form = ActiveForm::begin([
//        'action' => \yii\helpers\Url::to(['/cashbox/operation/add-transaction'])
    ]); ?>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <?= $form->errorSummary($model); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <?= $form->field($model, 'type')->dropDownList(['income' => 'Приход', 'outcome' => 'Расход'], ['options' => [ 'income' => ['selected ' => true]]]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <?= $form->field($model, 'sum')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <?= $form->field($model, 'cashbox_id')->dropDownList($cashboxes) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <?= Html::submitButton('Провести', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
