<?php

namespace halumein\cashbox\controllers;

use halumein\cashbox\models\Cashbox;
use Yii;
use halumein\cashbox\models\Operation;
use halumein\cashbox\models\search\Operationsearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * OperationController implements the CRUD actions for Operation model.
 */
class OperationController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $this->module->userRoles,
                    ]
                ]
            ],
        ];
    }

    /**
     * Lists all Operation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Operationsearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Operation model.
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
     * Creates a new Operation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Operation();

        $request = Yii::$app->request->post();

        if ($request){
            $model->date = date('Y:m:d H:i:s', time());
            $model->staffer_id = Yii::$app->user->id;
            $model->balance = 1; // Для прохождения на валидацию, т.к. balance обязательное поле
        }

        if ($model->load($request) && $model->save()) {
            $cashbox = Cashbox::findOne($model->cashbox_id);

            if ( $model->type === 'income' ) {
                $cashbox->balance += $model->sum;
            } elseif ( $model->type === 'outcome' ) {
                $cashbox->balance -= $model->sum;
            }

            $model->balance = $cashbox->balance;

            $model->save();
            $cashbox->save();

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Operation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Operation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Operation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
