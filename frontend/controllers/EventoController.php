<?php

namespace frontend\controllers;

use yii\filters\VerbFilter;
use yii\web\Controller;
use common\models\Evento;

class EventoController extends Controller
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
        $dataAtual = date('Y-m-d');

        $evento = Evento::find()->where(['>', 'data', $dataAtual])->orderBy('data ASC')->one();

        return $this->render('index', [
            'evento' => $evento,
        ]);
    }

}
