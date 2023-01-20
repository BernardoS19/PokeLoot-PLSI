<?php

namespace backend\modules\api\controllers;

use common\models\Baralho;
use common\models\User;
use Yii;
use yii\filters\auth\AuthInterface;
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

    public function actionNovo()
    {
        $authkey = Yii::$app->request->headers["auth"];

        if (User::findByAuthKey($authkey)) {
            $user = User::findByAuthKey($authkey);

            $baralho = new Baralho();
            $baralho->nome = $this->request->post("nome");
            $baralho->user_id = $user->id;

            if ($baralho->save()) {
                $myObj = new \stdClass();
                $myObj->status = "Baralho criado com sucesso";
                return $myObj;
            }
            else {
                $myObj = new \stdClass();
                $myObj->status = $baralho->errors;
                return $myObj;
            }
        }
        else {
            $myObj = new \stdClass();
            $myObj->error = "Erro. Utilizador não existe.";
            return $myObj;
        }
    }

}