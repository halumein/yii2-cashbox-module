<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

?>
<div class="payment-form">
    <?php $form = ActiveForm::begin([
        'id' => $model->formName(),
        'action' => $useAjax ? Url::to(['/cashbox/operation/payment-confirm-ajax']) : Url::to(['/cashbox/operation/payment-confirm']),
        'options' => [
            'data-role' => 'payment-form',
            'data-ajax' => $useAjax ? 'true' : 'false',
        ]
    ]); ?>

    <div class="hidden">
        <?= $form->field($model, 'item_id')->textInput(['value' => $order->id])?>
        <?= $form->field($model, 'itemCost')->textInput(['value' => $order->cost])?>
    </div>

    <div class="row row-centered">
        <div class="col-xs-12 col-centered col-fixed">
            <h1>Сумма к оплате: <span data-role="payment-cost"><?= $order->cost ?></h1>
        </div>
    </div>

    <div class="row row-centered">
        <div class="col-xs-12 col-centered col-fixed text-left">
            <?= $form->field($model, 'cashbox_id')->dropDownList(ArrayHelper::map($cashboxes, 'id', 'name')) ?>
        </div>
    </div>

    <div class="row row-centered">
        <div class="col-xs-12 col-centered col-fixed text-left">
            <?= $form->field($model, 'sum')->textInput([
                'maxlength' => true,
                'data-role' => 'payment-sum',
                'placeholder' => "внесено",
                'class' => "form-control"
                ]) ?>
        </div>
    </div>

    <div class="row row-centered">
        <div class="col-xs-12 col-centered col-fixed text-left">
            <?= $form->field($model, 'comment')->textArea([
                'class' => 'form-control',
                'rows' => 4,
                'data-role' => 'payment-comment'
                ]) ?>
        </div>
    </div>

    <div class="row row-centered">
        <div class="col-xs-12 col-centered col-fixed text-right">
            <h1>Сдача: <span data-role="payment-change">0</span></h1>
        </div>
    </div>

    <div class="row row-centered">
        <div class="col-xs-12 col-centered col-fixed text-right">
            <div class="form-group">
                <?= Html::submitButton('Провести оплату', [
                    'class' => 'btn btn-success',
                    'style' => 'width: 100%',
                    'id' => 'submit-payment'
                    ]) ?>
            </div>
        </div>
    </div>

    <div class="row row-centered">
        <div class="col-xs-12 col-centered col-fixed text-left">
            <span id="payment-notify"class="payment-form-notify"></span>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
</div>
