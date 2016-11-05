<?php
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-sm-12">
        <table class="table">
            <thead>
                <th>
                    Касса
                </th>
                <th>
                    Сумма по операциям за период
                </th>
                <th>
                    Остаток на конец периода
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

                                echo "<a href=\"" . Url::toRoute(['/cashbox/operation/index', ['OperationSearch' => ['date_start' => $dateStart, 'date_stop' => $dateStop]]]) . " title=\"приход-расход\">" . (int)$income . "-" . (int)$outcome . "=" . ($income - $outcome) . "</a>";
                                ?>
                        </td>
                        <td>
                            <?php
                            $date = $dateStop; 
                            if(!$date) {
                                $date = date('Y-m-d H:i:s');
                            }
                            ?>
                            <?= \Yii::$app->cashbox->getBalanceByDate($date, $cashbox->id); ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
