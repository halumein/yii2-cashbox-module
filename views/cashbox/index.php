<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

use pistol88\order\models\Order;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CashboxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Кассы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashbox-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Добавить кассу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'filter' => false,
            ],
            'name',
<<<<<<< HEAD
            [
                'attribute' => 'currency',
                'filter' => false,
            ],
            [
                'attribute' => 'balance',
                'filter' => false,
            ],
            //'user_ids',
            [
                'attribute' => 'user_ids',
                'content' => function($model) {
                    $stringUserNames = '';
                    foreach ($model->users as $user){
                        $stringUserNames = $stringUserNames . $user->username  . "; ";
                    }
                    return  Html::a($stringUserNames, ['/cashbox/cashbox/update', 'id' => $model->id]);
                },
//                'contentOptions' => [
//                    'width' => 450],
            ],


=======
            'currency',
            [
                'label' => 'Баланс',
                'attribute' => 'balance',
                'content' => function ($model) {
                    return Html::a($model->balance, ['/cashbox/operation/index', 'OperationSearch[cashbox_id]' => $model->id]);
                }
            ],
            // 'deleted',
>>>>>>> cashbox_operation_fixes
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 125px;']],
        ],
    ]);
    ?>

</div>
