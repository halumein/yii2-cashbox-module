if (typeof halumein === "undefined" || !halumein) {
    var halumein = {};
}

halumein.repaymentForm = {
	init : function() {
        $repaymentModal = $('[data-role=modal-repayment]');

        $repaymentModal.on('shown.bs.modal', function(e) {
            var self = this;
            halumein.repaymentForm.form = $(self).find('[data-role=repayment-form]');
            var $paymentInput = $(self).find('[data-role=payment-sum]'),
                paymentCost = +$(self).find('[data-role=payment-cost]').html(),
                $submit = $(self).find('[data-role=submit]'),
                $paymentChange = $(self).find('[data-role=payment-change]');

            $paymentInput.focus();
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
                    halumein.repaymentForm.sendData(e);
                }
            });

            $submit.on('click', function(e) {
            	halumein.repaymentForm.sendData(e);
            });
        });


	},

	sendData: function(e) {
		e.preventDefault();

		var $paymentInput = $('[data-role=payment-sum]'),
            $form = halumein.repaymentForm.form,
			income = +$form.find('[data-role=payment-sum]').val(),
			paymentCost = +$form.find('[data-role=payment-cost]').html(),
			csrfToken = $form.find('[name="_csrf"]').val(),
			useAjax = $form.data('ajax'),
			confirmUrl = $form.attr('action'),
            $submit = $form.find('[data-role=submit]'),
            $tools = $('[data-role=tools]');

			if (useAjax === true) {
				var serializedFormData = $form.serialize();

				$.ajax({
					type : 'POST',
					url : confirmUrl,
					data : serializedFormData,
                    beforeSend : function(){
                        $paymentInput.blur();
                        $submit.prop('disabled', true);
                    },
					success : function(response) {
						if (response.status === 'success') {
							location.reload();
						} else {
                            alert('ошибка проведения операции');
                            $submit.prop('disabled', false);
                        }
					},
					fail : function() {
                        $submit.prop('disabled', false);
						console.log('fail');
					}
				});

			} else {
				// console.log('use standart submit');
				$form.submit();
			}
			return false;
	},
}

// при первой загрузке запускаем инит
$(document).ready(function() {
	halumein.repaymentForm.init();
});

// при последующей перерисовке, переинитим нужные блоки
// $( document ).ajaxComplete(function( event, xhr, settings ) {
//     if (settings.url.indexOf("cashbox/tools/payment-form") !== -1) {
//         halumein.paymentForm.init();
//     }
// });
