<?php

namespace halumein\cashbox\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use halumein\cashbox\models\Cashbox;
use halumein\cashbox\models\Operation;
use halumein\cashbox\models\search\Operationsearch;

use pistol88\order\models\Order;

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
        $transaction = Yii::$app->operation->addTransaction($request);

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


    public function actionPaymentConfirm()
    {
        $request = Yii::$app->request->post();

        $model = new Operation();

        if ($model->load($request)) {

            $model->type = 'income';

            $order = Order::findOne($model->item_id);
            $cashbox = Cashbox::findOne($model->cashbox_id);

            // Костыль на обработку входящей суммы. Может быть меньше нужной (занесёт позже),
            // может быть больше (сдача), может быть вообще нуль(бесплатная мойка)
            // TODO вынести это извращение в отдельный модуль оплаты
            // что бы сюда поступали только транзацкции по кассе
            if ($model->sum > $order->cost) {
                $model->sum = $order->cost;
                $cashbox->balance += $order->cost;
                $order->status = 'paid'; // полностью оплачен
            } elseif ($model->sum < $order->cost) {
                $cashbox->balance += $model->sum;
                $order->status = 'half-paid'; // частично оплачен
            }


            $model->balance = $cashbox->balance;

            $model->date = date('Y:m:d H:i:s', time());
            $model->staffer_id = Yii::$app->user->id;
            $model->status = 'charged';

            // тип, сумма, ид_кассы, ид_стаффера, ид_ордера, статус, коммент,  модель-класс-нэйм, ид_клиента
            $response = $this->addTransaction($model->type, $model->balance, $model->sum, $model->cashbox_id, $model->staffer_id, $order->id, $model->status, $model->comment, $order::className());
            if ($response['status'] === 'ok') {
                $cashbox->save();
                $order->save();
                return $this->redirect(['/order/order/print', 'id' => $order->id]);
            } else {
                var_dump($response);
                // return $this->redirect('/service/price/order');
            }
        }
    }

    protected function addTransaction($type, $balance, $sum, $cashbox_id, $stafferId, $itemId = null, $status = 'created', $comment = null, $modelClass = null, $clientId = null)
    {

        $model = new Operation();

        $model->type = $type;
        if ($model->type === 'income') {
            $model->balance = $balance + $sum;
        }

        if ($model->type === 'outcome') {
            $model->balance = $balance - $sum;
        }

        $model->sum = (float)$sum;
        $model->cashbox_id = $cashbox_id;
        $model->model = $modelClass;
        $model->item_id = $itemId;
        $model->date = date('Y:m:d H:i:s');
        $model->client_id = $clientId;
        $model->staffer_id = $stafferId;
        $model->comment = $comment;
        $model->status = $status;

        if ($model->save()) {
            return [
                'status' => 'ok'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => $model->errors
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
