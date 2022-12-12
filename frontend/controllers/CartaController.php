<?php

namespace frontend\controllers;

use yii\filters\VerbFilter;
use yii\web\Controller;

class CartaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                    ],
                ],
            ]
        );
    }

    // Página de Catálogo
    public function actionIndex()
    {
        return $this->render('index');
    }

    // Página de detalhes da Carta
    public function actionDetalhes()
    {
        return $this->render('detalhes');
    }

}
