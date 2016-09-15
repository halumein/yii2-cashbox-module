if (typeof halumein == "undefined" || !halumein) {
    var halumein = {};
}


halumein.cashboxSelector = {
        init: function() {
            console.log('cashboxSelector init');
            var choiceItem = '.cashbox-choice-item';


            halumein.cashboxSelector.currentCashboxName = $('.cashbox-modal-trigger');
            halumein.cashboxSelector.modal = $('#cashbox-choice-modal'),
            halumein.cashboxSelector.csrf = $('meta[name=csrf-token]').attr("content");
            halumein.cashboxSelector.csrf_param = $('meta[name=csrf-param]').attr("content");

            $(document).on('click', choiceItem, this.setDefaultCashbox);

            return true;
        },

        setDefaultCashbox : function() {
            var self = this,
                url = $(self).data('url'),
                id = $(self).data('cashbox-id'),
                name = $(self).data('name')
            if (name !== halumein.cashboxSelector.currentCashboxName.html()) {
                $.ajax({
                    url : url,
                    type : 'POST',
                    data : { cashboxId : id},
                    beforeSend : function() {
                        halumein.cashboxSelector.modal.modal('hide');
                    },
                    success : function(response) {
                        if (response.status === 'success') {
                            halumein.cashboxSelector.updateCurrentCashboxName(name);
                        } else {
                            console.log(response.message);
                        }
                    },
                    fail : function() {
                        console.log('test');
                    }
                });
            } else {
                halumein.cashboxSelector.modal.modal('hide');
            }


        },
        updateCurrentCashboxName : function(name) {
            $block = halumein.cashboxSelector.currentCashboxName;
            $block.fadeOut(500, function() {
                $block.html(name);
                $block.fadeIn();
            });
        }

}

halumein.cashboxSelector.init();
