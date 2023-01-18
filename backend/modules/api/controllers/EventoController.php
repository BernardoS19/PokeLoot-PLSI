<?php

namespace backend\modules\api\controllers;

use common\models\Evento;
use common\models\User;
use Yii;
use yii\rest\ActiveController;

class EventoController extends ActiveController
{
    public $modelClass = 'common\models\Evento';

    public function actionProximo()
    {
        $authkey = Yii::$app->request->headers["auth"];

        if (User::findByAuthKey($authkey)) {
            $dataAtual = date('Y-m-d');
            $evento = Evento::find()->where(['>', 'data', $dataAtual])->orderBy('data ASC')->one();

            $myObj = new \stdClass();
            $myObj->id = $evento->id;
            $myObj->descricao = $evento->descricao;
            $myObj->data = date('d/m/Y', strtotime($evento->data));
            $myObj->latitude = $evento->latitude;
            $myObj->longitude = $evento->longitude;
        }
        else {
            $myObj = new \stdClass();
            $myObj->error = "Erro. Utilizador não existe.";
        }
        return $myObj;
    }

}