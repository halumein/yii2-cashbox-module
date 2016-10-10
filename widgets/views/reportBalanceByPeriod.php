<div class="row">
    <div class="col-sm-12">
        <table class="table">
            <thead>
                <th>
                    касса
                </th>
                <th>
                    Сумма по операциям за период
                </th>
                <th>
                    Остаток по кассе на текущий момент
                </th>
            </thead>
            <tbody>
                <?php foreach ($cashboxes as $key => $cashbox){ ?>
                    <tr>
                        <td>
                            <?= $cashbox->name ?>
                        </td>
                        <td>
                            <?= \Yii::$app->cashbox->getIncomeSumByPeriod($dateStart, $dateStop, $cashbox->id) ?>
                        </td>
                        <td>
                            <?= $cashbox->balance ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
