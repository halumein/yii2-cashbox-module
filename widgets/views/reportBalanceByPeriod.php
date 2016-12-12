<?php
use yii\helpers\Url;

$date = $dateStop; 
if(!$date) {
    $date = date('Y-m-d H:i:s');
}

$in = 0;
$out = 0;
$sum = 0;
?>
<div class="row">
    <div class="col-sm-12">
        <table class="table">
            <thead>
                <th>
                    Касса
                </th>
                <th>
                    Входящие
                </th>
                <th>
                    Исходящие
                </th>
                <th>
                    Остаток
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
                            $income = \Yii::$app->cashbox->getIncomeSumByPeriod($dateStart, $date, $cashbox->id);
                            $in+=$income;
                            echo "<a href=\"" . Url::toRoute(['/cashbox/operation/index', 'date_start' => $dateStart, 'date_stop' => $date, 'OperationSearch' => ['cashbox_id' => $cashbox->id, 'type' => 'income']]) . "\">".(int)$income."</a>";
                            ?>
                        </td>
                        <td>
                            
                            <?php
                            $outcome = \Yii::$app->cashbox->getOutcomeSumByPeriod($dateStart, $date, $cashbox->id);
                            $out+=$outcome;
                            echo "<a href=\"" . Url::toRoute(['/cashbox/operation/index', 'date_start' => $dateStart, 'date_stop' => $date, 'OperationSearch' => ['cashbox_id' => $cashbox->id, 'type' => 'outcome']]) . "\">".(int)$outcome."</a>";
                            ?>
                        </td>
                        <td>
                            <?php
                            $balance = \Yii::$app->cashbox->getBalanceByDate($date, $cashbox->id);
                            $sum+=(int)$balance;
                            echo "<a href=\"" . Url::toRoute(['/cashbox/operation/index', 'date_start' => $dateStart, 'date_stop' => $date, 'OperationSearch' => ['cashbox_id' => $cashbox->id]]) . "\">".(int)$balance."</a>";
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            
            <tfoot>
                <th>
                    Итого:
                </th>
                <th>
                    <?=$in;?>
                </th>
                <th>
                    <?=$out;?>
                </th>
                <th>
                    <?=$sum;?>
                </th>
            </tfoot>
        </table>
    </div>
</div>
