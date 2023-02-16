<?php

namespace backend\modules\api\controllers;

use common\models\Carta;
use common\models\Evento;
use common\models\Fatura;
use common\models\LinhaFatura;
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

    public function actionResgatar_carta()
    {
        $authkey = Yii::$app->request->headers["auth"];

        if (User::findByAuthKey($authkey)) {
            $user = User::findByAuthKey($authkey);
            $cartaId = Yii::$app->request->post("idCarta");

            $faturasPagas = Fatura::find()->where(['user_id' => $user->id, 'pago' => 1])->orderBy('data DESC')->all();

            $repetida = 0;
            if (Carta::find()->where(['id' => $cartaId])->exists()) {
                $carta = Carta::find()->where(['id' => $cartaId])->one();
                foreach ($faturasPagas as $fatura) {
                    foreach ($fatura->linhasFatura as $linha) {
                        if ($linha->carta_id == $carta->id) {
                            $repetida = 1;
                        }
                    }
                }
                if (!$repetida) {
                    $novaFatura = new Fatura();
                    $novaFatura->data = date('Y-m-d H:i:s');
                    $novaFatura->pago = 1;
                    $novaFatura->user_id = $user->id;
                    $novaFatura->save();

                    $novaLinha = new LinhaFatura();
                    $novaLinha->fatura_id = $novaFatura->id;
                    $novaLinha->carta_id = $carta->id;
                    $novaLinha->preco = $carta->preco;
                    $novaLinha->verificado = $carta->verificado;
                    $novaLinha->save();

                    $myObj = new \stdClass();
                    $myObj->status = "Carta resgatada com sucesso.";
                    return $myObj;
                }
                else {
                    $myObj = new \stdClass();
                    $myObj->error = "Erro. Carta já foi comprada previamente.";
                    return $myObj;
                }
            }
            else {
                $myObj = new \stdClass();
                $myObj->error = "Erro. Carta não existe.";
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