<div class="cashbox-selector">
    <a class="cashbox-modal-trigger" data-toggle="modal" data-target="#cashbox-choice-modal"> <?= $cashboxName ?> </a>
</div>

<div id="cashbox-choice-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Касса по умолчанию</h4>
      </div>
      <div class="modal-body text-center">
        <?= $cashboxList ?>
      </div>
    </div>
  </div>
</div>
