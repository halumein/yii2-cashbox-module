<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cashbox */

$this->title = 'Изменить кассу: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Кассы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="cashbox-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'activeUsers' => $activeUsers,
    ]) ?>

</div>
