if (typeof halumein === "undefined" || !halumein) {
    var halumein = {};
}

halumein.paymentForm = {
	init : function() {
		$paymentInput = $('[data-role=payment-sum]');
		paymentCost = +$('[data-role=payment-cost]').html();
		$paymentChange = $('[data-role=payment-change]');
        $submit = $('[data-role=submit-payment]');
		$cancel = $('#cancel-payment');

        $paymentInput.focus();
        $paymentInput.val(paymentCost);
        $paymentInput.select();
		// обработчик для поля внесённой суммы. осталвяем только цыфры и точку
		$paymentInput.keydown(function (e) {
	        // Allow: backspace, delete, tab, escape, enter and .
	        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
	             // Allow: Ctrl+A
	            (e.keyCode == 65 && e.ctrlKey === true) ||
	             // Allow: Ctrl+C
	            (e.keyCode == 67 && e.ctrlKey === true) ||
	             // Allow: Ctrl+X
	            (e.keyCode == 88 && e.ctrlKey === true) ||
	             // Allow: home, end, left, right
	            (e.keyCode >= 35 && e.keyCode <= 39)) {
	                 // let it happen, don't do anything
	                 return;
	        }
	        // Ensure that it is a number and stop the keypress
	        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	            e.preventDefault();
	        }
	    });

		$paymentInput.keyup(function (e) {
			var income = +$paymentInput.val();
			if (income > paymentCost) {
				$paymentChange.html(income - paymentCost);
			} else {
				$paymentChange.html(0);
			}

            if (e.keyCode == 13) {
                halumein.paymentForm.sendData(e);
            }
		});

		$submit.on('click', function(e) {
			halumein.paymentForm.sendData(e);
		});

        $cancel.on('click', function() {
            halumein.paymentForm.cancel();
        });
	},

	sendData: function(e) {
		e.preventDefault();

		var $paymentInput = $('[data-role=payment-sum]'),
			income = +$paymentInput.val(),
			paymentCost = +$('[data-role=payment-cost]').html(),
			$comment = $('[data-role=payment-comment]'),
			$notify = $('#payment-notify'),
			$form = $('[data-role=payment-form]'),
			csrfToken = $form.find('[name="_csrf"]').val(),
			useAjax = $form.data('ajax'),
			nextStep = $form.data('next-step'),
			confirmUrl = $form.attr('action'),
            $tools = $('[data-role=tools]');


		if ((income < paymentCost) && $comment.val() === '' && !$tools.data('less-sum')) {
			$notify.html('Внимание! Укажите в комментарии, почему сумма платежа меньше суммы заказа.').slideDown();
		} else {
			$notify.slideUp();
			$notify.html();

			if (useAjax === true) {
				var serializedFormData = $form.serialize();

				$.ajax({
					type : 'POST',
					url : confirmUrl,
					data : serializedFormData,
                    beforeSend : function(){
                        $paymentInput.blur();
                    },
					success : function(response) {
						pistol88.service.clearServiceOrder();
						if (response.status === 'success' && typeof response.nextStep != 'undefined' && response.nextStep != false) {
							// console.log(response.nextStep);
							$form.parent().animate({width:'toggle'},350);
							$form.parent().parent().load(response.nextStep);

                            if (response.printRedirect !== null) {
                                $('#orderSubmitter').attr('src', response.printRedirect);
                            }
						} else {
                            alert('ошибка проведения операции');
                        }
					},
					fail : function() {
						console.log('fail');
					}
				});

			} else {
				// console.log('use standart submit');
				$form.submit();
			}
			return false;
		}
	},
    cancel : function () {
        var $form = $('[data-role=payment-form]'),
            nextStep = $form.data('next-step');
            $form.parent().animate({width:'toggle'},350);
            $form.parent().parent().load(nextStep);
            pistol88.service.clearServiceOrder();
    }
}

// при первой загрузке запускаем инит
// $(document).ready(function() {
// 	halumein.paymentForm.init();
// });

// при последующей перерисовке, переинитим нужные блоки
$( document ).ajaxComplete(function( event, xhr, settings ) {
    if (settings.url.indexOf("cashbox/tools/payment-form") !== -1) {
        halumein.paymentForm.init();
    }
});
