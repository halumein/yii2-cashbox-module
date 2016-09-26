<?php
namespace halumein\cashbox\controllers;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\helpers\Url;

use halumein\cashbox\models\Cashbox;
use halumein\cashbox\models\Operation;


class ToolsController extends Controller
{
    /**
    * @param $id - идешник ордера
    * @param $useAjax - использовать ajax для отправки формы
    */

    public function actionPaymentForm($id, $useAjax = false)
    {
        $orderModel = $this->module->orderModel;
        $order = $orderModel::findOne($id);

        if ($order) {
            $model = new Operation();
            $cashboxes = Cashbox::getActiveCashboxes();

            return $this->renderAjax('paymentForm', [
                'order' => $order,
                'useAjax' => $useAjax,
            ]);
        }
    }

    public function actionSetUserDefaultCashbox()
    {
        $cashboxId = Yii::$app->request->post('cashboxId');

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $userModel = $this->module->userModel;

        if ($userModel->setDefaultCashbox($cashboxId)) {
            return [
                'status' => 'success',
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'unable to save data'
            ];
        }

    }

}
