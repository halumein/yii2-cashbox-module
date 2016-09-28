<?php

namespace halumein\cashbox\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use halumein\cashbox\models\Cashbox;
use halumein\cashbox\models\Exchange;
use halumein\cashbox\models\search\ExchangeSearch;

class ExchangeController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $this->module->adminRoles,
                    ]
                ]
            ],
        ];
    }
    /**
     * Lists all Exchange models.
     * @return mixed
     */
    public function actionIndex()
    {
        $cashbox = new Cashbox();
        $searchModel = new ExchangeSearch();

        $searchParams = Yii::$app->request->queryParams;
        $searchParams['ExchangeSearch']['deleted'] = null;
        $dataProvider = $searchModel->search($searchParams);

        $userModelModel = $this->module->userModel;
        $activeUsers = $userModelModel::find()->all();

//        echo "<pre>";
//        var_dump($dataProvider);

        return $this->render('index', [
            'activeCashboxes' => $cashbox->activeCashboxes,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'activeUsers' => $activeUsers,
        ]);
    }

    /**
     * Displays a single Exchange model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Exchange model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Exchange();

        if ($model->load(Yii::$app->request->post())) {
            $postData = Yii::$app->request->post();
            if ($model->from_cashbox_id === $model->to_cashbox_id){
                Yii::$app->getSession()->setFlash('error', "Касса списания не может быть кассой приема!");
                return $this->render('create', [
                    'model' => $model,
                    'activeCashboxes' => Cashbox::getActiveCashboxes(),
                ]);
            }

            $model->staffer_id = Yii::$app->user->identity->id;
            $model->date = date("Y-m-d H:i:s");

            $model->rate =  $postData['Exchange']['rate'] ? $postData['Exchange']['rate'] : 1;

            if ($model->save()) {

                $type = 'outcome';
                $sum = $postData['Exchange']['from_sum'];
                $cashbox_id = $postData['Exchange']['from_cashbox_id'];
                $comment = $model->comment ? $model->comment : 'Перевод между кассами';

                $transaction = Yii::$app->cashboxOperation->addTransaction($type, $sum, $cashbox_id, null, $comment);

                $type = 'income';
                $sum = $postData['Exchange']['to_sum'];
                $cashbox_id = $postData['Exchange']['to_cashbox_id'];
                $transaction = Yii::$app->cashboxOperation->addTransaction($type, $sum, $cashbox_id, null, $comment);

                return $this->redirect(['index']);
            }
        } else {
                return $this->render('create', [
                    'model' => $model,
                    'activeCashboxes' => Cashbox::getActiveCashboxes(),
                ]);
        }
    }

    /**
     * Updates an existing Exchange model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cashbox = new Cashbox();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'activeCashboxes' => $cashbox->activeCashboxes,
            ]);
        }
    }

    /**
     * Deletes an existing Exchange model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->deleted = date('Y:m:d H:i:s', time());
        if ($model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('/error', [
                'error' => $model->errors
            ]);
        }
    }

    /**
     * Finds the Exchange model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Exchange the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Exchange::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
