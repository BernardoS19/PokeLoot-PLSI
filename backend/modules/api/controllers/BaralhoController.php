<?php

namespace backend\modules\api\controllers;

use common\models\Baralho;
use common\models\BaralhoCarta;
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

    public function actionEditar()
    {
        $authkey = Yii::$app->request->headers["auth"];

        if (User::findByAuthKey($authkey)) {
            $user = User::findByAuthKey($authkey);

            $baralho = Baralho::find()->where(['id' => $this->request->post("id")])->one();
            $baralho->nome = $this->request->post("nome");
            $baralho->user_id = $user->id;

            if ($baralho->save()) {
                $myObj = new \stdClass();
                $myObj->status = "Baralho editado com sucesso";
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

    public function actionRemover()
    {
        $authkey = Yii::$app->request->headers["auth"];

        if (User::findByAuthKey($authkey)) {
            $user = User::findByAuthKey($authkey);

            $baralho = Baralho::find()->where(['id' => $this->request->post("id")])->one();

            $cartasDoBaralho = BaralhoCarta::find()->where(['baralho_id' => $baralho->id])->all();
            foreach ($cartasDoBaralho as $carta) {
                $carta->delete();
            }

            if ($baralho->delete()) {
                $myObj = new \stdClass();
                $myObj->status = "Baralho eliminado com sucesso";
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

    public function actionCartas()
    {
        $authkey = Yii::$app->request->headers["auth"];

        $baralhoId = intval(Yii::$app->request->headers["baralhoId"]);

        if (User::findByAuthKey($authkey)) {
            $user = User::findByAuthKey($authkey);
            $baralho = Baralho::find()->where(['id' => $baralhoId, 'user_id' => $user->id])->one();

            $cartas = array();
            foreach ($baralho->cartas as $carta) {
                $myObj = new \stdClass();
                $myObj->id = $carta->id;
                $myObj->imagem = base64_encode(file_get_contents(Yii::getAlias('@imgurl').'/'.$carta->imagem->nome));
                $myObj->nome = $carta->nome;
                $myObj->descricao = $carta->descricao;
                $myObj->tipo = $carta->tipo->nome;
                $myObj->elemento = $carta->elemento->nome;
                $myObj->colecao = $carta->colecao->nome;
                array_push($cartas, $myObj);
            }
            return $cartas;
        }
        else {
            $myObj = new \stdClass();
            $myObj->error = "Erro. Utilizador não existe.";
            return $myObj;
        }
    }
}