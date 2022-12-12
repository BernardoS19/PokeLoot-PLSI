<?php

namespace frontend\controllers;

use yii\filters\VerbFilter;
use yii\web\Controller;

class Lista_desejosController extends Controller
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


    public function actionIndex()
    {
        return $this->render('index');
    }

}
