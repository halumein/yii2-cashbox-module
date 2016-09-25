<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model halumein\cashbox\models\Revision */

$this->title = 'Добавить инкассацию';
$this->params['breadcrumbs'][] = ['label' => 'Инкассации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="revision-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'activeCashboxes' => $activeCashboxes,
    ]) ?>

</div>
