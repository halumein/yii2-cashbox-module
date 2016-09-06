<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Cashbox */

$this->title = 'Create Cashbox';
$this->params['breadcrumbs'][] = ['label' => 'Cashboxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashbox-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
