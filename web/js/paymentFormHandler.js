$(function () {
	/* some scripts */

	var $paymentInput = $('[data-role=payment-sum]');
		paymentCost = +$('[data-role=payment-cost]').html();
		$paymentChange = $('[data-role=payment-change]'),
		$submit = $('#submit-payment'),
		$comment = $('[data-role=payment-comment]'),
		$notify = $('#payment-notify'),
		$form = $('[data-role=payment-form]');


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
	});

	$submit.on('click', function(e) {
		e.preventDefault();

		var income = +$paymentInput.val();
		if ((income < paymentCost) && $comment.val() === '') {
			$notify.html('Внимание! Укажите в комментарии, почему сумма платежа меньше суммы заказа.').slideDown();
		} else {
			$notify.slideUp();
			$notify.html('Внимание! Укажите в комментарии, почему сумма платежа меньше суммы заказа.');
			$form.submit();
		}



	})

});
