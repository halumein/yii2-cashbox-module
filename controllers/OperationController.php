<?php

namespace halumein\cashbox\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use halumein\cashbox\models\Cashbox;
use halumein\cashbox\models\Operation;
use halumein\cashbox\models\search\Operationsearch;

use yii\helpers\Url;
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
        $request = Yii::$app->request->post();

        $type = $request['Operation']['type'];
        $sum = $request['Operation']['sum'];
        $cashboxId = $request['Operation']['cashbox_id'];
        $comment = $request['Operation']['comment'];
        $itemId = null;

        $transaction = Yii::$app->cashboxOperation->addTransaction($type, $sum, $cashboxId, $itemId, $comment);

        if ($transaction['status']) {
            return $this->redirect(['index']);
        } else {
            $model = new Operation();

            if ($request) {
                $model->addErrors($transaction['message']);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
    * Оплата.
    * TODO вынести в другой модуль.
    */

    public function actionPaymentConfirm()
    {
        $request = Yii::$app->request->post();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;


        if ($request) {
            $type = 'income';
            $itemId = $request['Operation']['item_id'];
            $cashboxId = $request['Operation']['cashbox_id'];
            $comment = $request['Operation']['comment'];
            // ёбаный стыд, но пока так. проверяет если внесено больше денег чем стоит заказ (крупная купюра с которой сдали)
            // то присваиваем входящую сумму равной стоимости заказа.
            if ($request['Operation']['sum'] > $request['Operation']['itemCost'] ) {
                $sum = $request['Operation']['itemCost'];
            } else {
                $sum = $request['Operation']['sum'];
            }
            $transaction = Yii::$app->cashboxOperation->addTransaction($type, $sum, $cashboxId, $itemId, $comment);

            if ($transaction['status']) {
                return $this->redirect([$this->module->paymentSuccessRedirect]);
            } else {
                $model = new Operation();

                if ($request) {
                    $model->addErrors($transaction['message']);
                }

                var_dump($model->errors);
                die;
            }
        } else {
            return [
                'status' => 'error',
                'message' => 'no data'
            ];
        }
    }

    public function actionPaymentConfirmAjax()
    {
        $request = Yii::$app->request->post();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if ($request) {
            $type = 'income';
            $itemId = $request['Operation']['item_id'];
            $cashboxId = $request['Operation']['cashbox_id'];
            $comment = $request['Operation']['comment'];

            // проверяет если внесено больше денег чем стоит заказ (крупная купюра с которой сдали)
            // то присваиваем входящую сумму равной стоимости заказа.
            if ($request['Operation']['sum'] > $request['Operation']['itemCost'] ) {
                $sum = $request['Operation']['itemCost'];
            } else {
                $sum = $request['Operation']['sum'];
            }
            $transaction = Yii::$app->cashboxOperation->addTransaction($type, $sum, $cashboxId, $itemId, $comment);

            if ($transaction) {

                // TODO избавиться от сильной связанности
                $nextStepAction = Url::to(['/order/order/get-order-form-light', 'useAjax' => 1]);

                if ($this->module->printRedirect) {
                    $printRedirect = Url::to([$this->module->printRedirect, 'id' => $itemId]);
                } else {
                    $printRedirect = null;
                }

                return [
                    'status' => 'success',
                    'nextStep' => $nextStepAction,
                    'printRedirect' => $printRedirect
                ];
            } else {
                return [
                    'status' => 'error',
                ];
            }
        } else {
            return [
                'status' => 'error',
                'message' => 'no data'
            ];
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
