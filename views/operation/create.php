<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\Operation */

$this->title = 'Проведение операции';
$this->params['breadcrumbs'][] = ['label' => 'Операции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operation-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
