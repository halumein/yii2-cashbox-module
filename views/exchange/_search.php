<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExchangeSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="exchange-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'from_cashbox_id') ?>

    <?php echo $form->field($model, 'from_sum') ?>

    <?php echo $form->field($model, 'to_cashbox_id') ?>

    <?php echo $form->field($model, 'to_sum') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <?php // echo $form->field($model, 'staffer_id') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
