<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Exchange */

$this->title = 'Добавить перевод';
$this->params['breadcrumbs'][] = ['label' => 'Переводы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exchange-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'activeCashboxes' => $activeCashboxes
    ]) ?>

</div>
