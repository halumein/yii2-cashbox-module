<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Exchange */

$this->title = 'Изменить перевод: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Переводы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="exchange-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'activeCashboxes' => $activeCashboxes,
    ]) ?>

</div>
