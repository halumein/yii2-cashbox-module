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

    public function actionGetIframeRedirect($id)
    {
        return '<script>parent.document.location = "' . Url::to(['/cashbox/tools/payment-form', 'orderId' => $id]) . '"; </script>';
    }

    public function actionPaymentForm($orderId)
    {
        $orderModel = $this->module->orderModel;
        $order = $orderModel::findOne($orderId);

        if ($order) {
            $model = new Operation();
            $cashboxes = Cashbox::getActiveCashboxes();

            return $this->render('payment', [
                'model' => $model,
                'order' => $order,
                'cashboxes' => $cashboxes
            ]);
        } else {
            return $this->redirect(['/service/price/order']);
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
