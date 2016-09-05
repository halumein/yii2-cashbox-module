<?php

namespace halumein\cashbox\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use halumein\cashbox\models\cashbox\CashboxService;


/**
 * Cashbox controller for
 */
class CashboxController extends Controller
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render("index");
    }

    public function renderCashbox(CashboxService $cashbox)
    {
        return $this->renderPartial('_article', [
             'author' => $article->getAuthor(),
             'title' => $article->getTitle()
        ]);
    }
}
