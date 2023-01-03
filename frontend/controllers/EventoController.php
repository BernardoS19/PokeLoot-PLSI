<?php

namespace frontend\controllers;

use yii\filters\VerbFilter;
use yii\web\Controller;
use common\models\Evento;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;

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

        if ($evento != null)
        {
            $coord = new LatLng(['lat' => (float)$evento->latitude, 'lng' => (float)$evento->longitude]);

            $map = new Map([
                'width' => 700,
                'height' => 400,
                'center' => $coord,
                'zoom' => 15,
            ]);

            $marker = new Marker([
                'position' => $coord,
                'title' => 'Local do Evento',
            ]);

            $map->addOverlay($marker);
        }
        else {
            $map = null;
        }


        return $this->render('index', [
            'evento' => $evento,
            'map' => $map,
        ]);
    }

}
