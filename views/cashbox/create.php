<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Cashbox */

$this->title = 'Добавить кассу';
$this->params['breadcrumbs'][] = ['label' => 'Кассы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashbox-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'activeUsers' => $activeUsers,
    ]) ?>

</div>
