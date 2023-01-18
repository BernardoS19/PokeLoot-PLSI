<?php

namespace backend\modules\api\controllers;

use common\models\Baralho;
use common\models\User;
use Yii;
use yii\rest\ActiveController;

class BaralhoController extends ActiveController
{
    public $modelClass = 'common\models\Baralho';

    public function actionLista()
    {
        $authkey = Yii::$app->request->headers["auth"];

        if (User::findByAuthKey($authkey)) {
            $user = User::findByAuthKey($authkey);
            $baralhosDoUser = Baralho::find()->where(['user_id' => $user->id])->all();

            $baralhos = array();
            foreach ($baralhosDoUser as $baralho) {
                $myObj = new \stdClass();
                $myObj->id = $baralho->id;
                $myObj->nome = $baralho->nome;
                array_push($baralhos, $myObj);
            }
            return $baralhos;
        }
        else {
            $myObj = new \stdClass();
            $myObj->error = "Erro. Utilizador não existe.";
            return $myObj;
        }
    }

}