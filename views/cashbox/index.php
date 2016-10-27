<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Кассы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashbox-index">
    
    <div class="row">
        <div class="col-sm-3">
            <p>
                <?= Html::a('Добавить кассу', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="col-sm-9">
                <div class="service-menu">
                    <?=$this->render('../_common/menu');?>
                </div>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'filter' => false,
            ],
            'name',
            [
                'attribute' => 'currency',
                'filter' => false,
            ],
            [
                'attribute' => 'user_ids',
                'content' => function($model) {
                    $stringUserNames = '';
                    foreach ($model->users as $user){
                        $stringUserNames = $stringUserNames . $user->username  . "; ";
                    }
                    return  Html::a($stringUserNames, ['/cashbox/cashbox/update', 'id' => $model->id]);
                },
            ],
            [
                'label' => 'Баланс',
                'attribute' => 'balance',
                'content' => function ($model) {
                    return Html::a($model->balance, ['/cashbox/operation/index', 'OperationSearch[cashbox_id]' => $model->id]);
                }
            ],
            // 'deleted',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'visible' => Yii::$app->user->can('superadmin'),
                'buttonOptions' => ['class' => 'btn btn-default'],
                'options' => ['style' => 'width: 125px;']
            ],
        ],
    ]);
    ?>

</div>
