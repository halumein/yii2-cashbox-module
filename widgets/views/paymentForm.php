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
            'data-next-step' =>  Url::to(['/order/order/get-order-form-light', 'useAjax' => $useAjax ? 1 : 0,]),
        ]
    ]); ?>

    <div class="hidden" data-role="tools" data-less-sum=<?= $lessSum ?>>
        <?= $form->field($model, 'item_id')->textInput(['value' => $order->id])?>
        <?= $form->field($model, 'itemCost')->textInput(['value' => $order->cost])?>
        <?= $form->field($model, 'paymentTypeId')->textInput(['value' => $order->payment_type_id])?>
    </div>

    <div class="row row-centered">
        <div class="col-xs-12 col-centered col-fixed text-right">
            <div class="form-group">
                <?= Html::button('Провести оплату', [
                    'class' => 'btn btn-success',
                    'id' => 'submit-payment',
                    'data-role' =>"submit-payment",
                    'style' => 'width: 100%'
                ]); ?>
            </div>
        </div>
    </div>

    <div class="row row-centered">
        <div class="col-xs-12 col-centered col-fixed">
            <h3>Сумма к оплате: <span data-role="payment-cost"><?= $order->cost ?></h3>
        </div>
    </div>

    <div class="row row-centered">
        <div class="col-xs-12 col-centered col-fixed text-left">
            <?= $form->field($model, 'cashbox_id')->dropDownList(ArrayHelper::map($cashboxes, 'id', 'name')) ?>
        </div>
    </div>

    <div class="row row-centered">
        <div class="col-xs-6 col-centered col-fixed text-left">
            <?= $form->field($model, 'sum')->textInput([
                'maxlength' => true,
                'data-role' => 'payment-sum',
                'placeholder' => "внесено",
                'class' => "form-control"
                ]) ?>
        </div>
		<div class="col-xs-6 col-centered col-fixed text-left">
			<p><label>Сдача:</label></p>
			<div class="delivery"><strong data-role="payment-change">0</strong></div>
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
    <div>
		<p><span id="payment-notify"class="payment-form-notify"></span></p>
    </div>

    <div class="row row-centered">
        <div class="col-xs-12 col-centered col-fixed text-right">
            <div class="form-group">
                <?= Html::button('Провести оплату', [
                    'class' => 'btn btn-success',
                    'id' => 'submit-payment',
                    'data-role' =>'submit-payment',
                    'style' => 'width: 100%'
                ]); ?>
            </div>
        </div>
    </div>

    <div class="row row-centered">
        <div class="col-xs-12 col-centered col-fixed text-right">
            <div class="form-group">
                <?= Html::button('Без оплаты', ['class' => 'btn btn-danger', 'id' => 'cancel-payment', 'style' => 'width: 100%']); ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<style>
.payment-form .delivery {
	font-size: 13px;
}

.payment-form .text-danger {
	position: absolute;
	line-height: 14px;
}
</style>
