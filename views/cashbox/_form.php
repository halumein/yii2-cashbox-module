<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
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
        <div class="col-md-3 col-xs-6">
            <?php if(yii::$app->has('organization') && $organization = yii::$app->get('organization')) { ?>
                <?php echo $form->field($model, 'organization_id')->dropDownList(ArrayHelper::map($organization->getList(), 'id', 'name'), ['prompt' => 'Нет']) ?>
            <?php } ?>
        </div>
    </div>

    <?php
    //на dropDownList c мультивыбором
    //echo $form->field($model, 'user_ids')->label('Пользователи, которые имеют доступ')->dropDownList(ArrayHelper::map($activeUsers,'id','username'), ['multiple' => true]);
    ?>

    <?php
    //на Select2 c мультивыбором
    echo $form->field($model, 'user_ids')->label('Пользователи, которые имеют доступ')
        ->widget(Select2::classname(), [
            'data' => ArrayHelper::map($activeUsers, 'id', 'username'),
            'language' => 'ru',
            'options' => ['multiple' => true, 'placeholder' => 'Выберите пользователей ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <?php echo Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
