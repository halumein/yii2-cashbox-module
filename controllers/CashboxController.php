<?php

namespace halumein\cashbox\controllers;

use yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use halumein\cashbox\models\Cashbox;
use halumein\cashbox\models\search\CashboxSearch;

class CashboxController extends Controller
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
                    ],
                ]
            ],
        ];
    }

   /**
    * Lists all CashboxCashbox models.
    * @return mixed
    */
   public function actionIndex()
   {
       $searchModel = new CashboxSearch();

       $searchParams = Yii::$app->request->queryParams;
       $searchParams['CashboxSearch']['deleted'] = null;

       $dataProvider = $searchModel->search($searchParams);

       return $this->render('index', [
           'searchModel' => $searchModel,
           'dataProvider' => $dataProvider,
       ]);
   }

   /**
    * Displays a single CashboxCashbox model.
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
    * Creates a new CashboxCashbox model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return mixed
    */
   public function actionCreate()
   {
       $model = new Cashbox();

       if ($model->load(Yii::$app->request->post()) && $model->save()) {
           return $this->redirect('index');
       } else {
           return $this->render('create', [
               'model' => $model,
               'activeUsers' => Yii::$app->getModule('cashbox')->cashiersList,
           ]);
       }
   }

   /**
    * Updates an existing CashboxCashbox model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id
    * @return mixed
    */
   public function actionUpdate($id)
   {
       $model = $this->findModel($id);

       if ($model->load(Yii::$app->request->post()) && $model->save()) {
           return $this->redirect(['index']);
       } else {
        //    $userModelModel = $this->module->userModel;
        //    $activeUsers = $userModelModel::find()->active()->all();
           return $this->render('update', [
               'model' => $model,
               'activeUsers' => Yii::$app->getModule('cashbox')->cashiersList,
           ]);
       }
   }

   /**
    * Deletes an existing CashboxCashbox model.
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
    * Finds the CashboxCashbox model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return CashboxCashbox the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
   protected function findModel($id)
   {
       if (($model = Cashbox::findOne($id)) !== null) {
           return $model;
       } else {
           throw new NotFoundHttpException('The requested page does not exist.');
       }
   }
}
