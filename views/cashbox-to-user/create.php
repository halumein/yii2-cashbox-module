<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\CashboxToUser */

$this->title = 'Create Cashbox To User';
$this->params['breadcrumbs'][] = ['label' => 'Cashbox To Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashbox-to-user-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
