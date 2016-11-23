<?php
use yii\helpers\Url;

$date = $dateStop; 
if(!$date) {
    $date = date('Y-m-d H:i:s');
}
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
                    Исходящие (в т.ч. отмененные)
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
                            $income = \Yii::$app->cashbox->getIncomeSumByPeriod($dateStart, $date, $cashbox->id);
                            echo "<a href=\"" . Url::toRoute(['/cashbox/operation/index', 'date_start' => $dateStart, 'date_stop' => $date, 'OperationSearch' => ['cashbox_id' => $cashbox->id, 'type' => 'income']]) . "\">".(int)$income."</a>";
                            ?>
                        </td>
                        <td>
                            
                            <?php
                            $outcome = \Yii::$app->cashbox->getOutcomeSumByPeriod($dateStart, $date, $cashbox->id);
                            echo "<a href=\"" . Url::toRoute(['/cashbox/operation/index', 'date_start' => $dateStart, 'date_stop' => $date, 'OperationSearch' => ['cashbox_id' => $cashbox->id, 'type' => 'outcome']]) . "\">".(int)$outcome."</a>";
                            ?>
                        </td>
                        <td>
                            <?php
                            $balance = \Yii::$app->cashbox->getBalanceByDate($date, $cashbox->id);
                            echo "<a href=\"" . Url::toRoute(['/cashbox/operation/index', 'date_start' => $dateStart, 'date_stop' => $date, 'OperationSearch' => ['cashbox_id' => $cashbox->id]]) . "\">".(int)$balance."</a>";
                            ?>
                            
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
