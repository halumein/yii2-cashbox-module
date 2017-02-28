<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

if(yii::$app->has('organization')) {
    $organizations = yii::$app->organization->getList();
    $organizations = ArrayHelper::map($organizations, 'id', 'name');
} else {
    $organizations = [];
}



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
                'attribute' => 'organization_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'organization_id',
                    $organizations,
                    ['class' => 'form-control', 'prompt' => 'Организация']
                ),
                'content' => function($model) use ($organizations) {
                    foreach($organizations as $id => $name) {
                        if($id == $model->organization_id) {
                            return $name;
                        }
                    }

                    return '';
                }
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
                'visible' => Yii::$app->user->can(\Yii::$app->getModule('cashbox')->cashboxAdminRole),
                'buttonOptions' => ['class' => 'btn btn-default'],
                'options' => ['style' => 'width: 125px;']
            ],
        ],
    ]);
    ?>

</div>
