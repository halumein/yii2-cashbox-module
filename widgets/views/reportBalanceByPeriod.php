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
                            <?php
                                $income = \Yii::$app->cashbox->getIncomeSumByPeriod($dateStart, $dateStop, $cashbox->id);
                                $outcome = \Yii::$app->cashbox->getOutcomeSumByPeriod($dateStart, $dateStop, $cashbox->id);

                                echo $income - $outcome;
                                ?>
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
