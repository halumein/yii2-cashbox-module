<?php

namespace halumein\cashbox\controllers;

use halumein\cashbox\models\Cashbox;
use Yii;
use halumein\cashbox\models\Exchange;
use halumein\cashbox\models\search\ExchangeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExchangeController implements the CRUD actions for Exchange model.
 */
class ExchangeController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
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

        $userForCashboxModel = $this->module->userForCashbox;
        $activeUsers = $userForCashboxModel::find()->all();

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
        $cashbox = new Cashbox();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->from_cashbox_id === $model->to_cashbox_id){
                Yii::$app->getSession()->setFlash('error', "Касса списания не может быть кассой приема!");
                return $this->render('create', [
                    'model' => $model,
                    'activeCashboxes' => $cashbox->activeCashboxes,
                ]);
            }




            $model->staffer_id = Yii::$app->user->identity->id;
            $model->date = date("Y-m-d H:i:s");
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
                return $this->render('create', [
                    'model' => $model,
                    'activeCashboxes' => $cashbox->activeCashboxes,
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
