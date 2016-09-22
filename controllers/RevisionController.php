<?php

namespace halumein\cashbox\controllers;

use halumein\cashbox\models\Cashbox;
use Yii;
use halumein\cashbox\models\Revision;
use halumein\cashbox\models\search\RevisionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RevisionController implements the CRUD actions for Revision model.
 */
class RevisionController extends Controller
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
     * Lists all Revision models.
     * @return mixed
     */
    public function actionIndex()
    {
        $cashbox = new Cashbox();

        $searchModel = new RevisionSearch();
        $searchParams = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($searchParams);

        $userForCashboxModel = $this->module->userForCashbox;
        $activeUsers = $userForCashboxModel::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'activeCashboxes' => $cashbox->activeCashboxes,
            'activeUsers' => $activeUsers,
        ]);
    }

    /**
     * Displays a single Revision model.
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
     * Creates a new Revision model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Revision();
        $cashbox = new Cashbox();

        if ($model->load(Yii::$app->request->post())) {
                $model->user_id = Yii::$app->user->identity->id;
                $model->date = date("Y-m-d H:i:s");
                if ($model->save()){
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
     * Updates an existing Revision model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cashbox = new Cashbox();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'activeCashboxes' => $cashbox->activeCashboxes,
            ]);
        }
    }

    /**
     * Deletes an existing Revision model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Revision model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Revision the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Revision::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
