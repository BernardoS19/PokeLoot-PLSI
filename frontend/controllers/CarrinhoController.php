<?php

namespace frontend\controllers;

use common\models\LinhaFatura;

use common\models\User;
use common\models\Carta;
use common\models\Fatura;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class CarrinhoController extends Controller
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
        if (!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->identity->id;
            $linhasfatura = null;
            $precoTotal = null;

            if (Fatura::findOne(['user_id' => $userId, 'pago' => 0, 'data' => null]) != null) {
                if (!empty(Fatura::findOne(['user_id' => $userId, 'pago' => 0, 'data' => null])->linhasFatura)) {
                    $fatura = Fatura::findOne(['user_id' => $userId, 'pago' => 0, 'data' => null]);
                    $linhasfatura = LinhaFatura::find()->where(['fatura_id' => $fatura->id])->all();
                    $precoTotal = LinhaFatura::find()->where(['fatura_id' => $fatura->id])->join('RIGHT JOIN', 'carta', 'carta.id = linha_fatura.carta_id')->sum('carta.preco');
                }
            }
        } else {
            Yii::$app->session->setFlash('error', 'É necessária autenticação para esta funcionalidade');
            return $this->redirect(['site/login']);
        }
        return $this->render('index', [
                'linhasfatura' => $linhasfatura,
                'precoTotal' => $precoTotal,
            ]);
    }

    public function actionAdicionar($cartaId)
    {
        if (!Yii::$app->user->isGuest)
        {
            $userId = Yii::$app->user->identity->id;
            $carta = Carta::findOne($cartaId);

            if ($carta != null) {
                if (Fatura::findOne(['user_id' => $userId, 'pago' => 0, 'data' => null]) != null) {
                    $carrinho = Fatura::findOne(['user_id' => $userId, 'pago' => 0, 'data' => null]);
                } else {
                    $carrinho = new Fatura();
                    $carrinho->user_id = $userId;
                    $carrinho->save();
                }

                $linhafatura = new LinhaFatura();
                $linhafatura->fatura_id = $carrinho->id;
                $linhafatura->carta_id = $cartaId;

                if ($linhafatura->save()) {
                    Yii::$app->session->setFlash('success', 'Carta adicionada ao Carrinho de compras');
                } else {
                    Yii::$app->session->setFlash('error', 'Carta já se encontra no carrinho');
                }
            }
        } else {
            Yii::$app->session->setFlash('error', 'É necessária autenticação para esta funcionalidade');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionRemover($cartaId)
    {
        if (!Yii::$app->user->isGuest)
        {
            $userId = Yii::$app->user->identity->id;
            $carta = Carta::findOne($cartaId);

            if ($carta != null) {
                $fatura = Fatura::findOne(['user_id' => $userId, 'pago' => 0, 'data' => null]);
                $linhaFatura = LinhaFatura::findOne(['fatura_id' => $fatura->id, 'carta_id' => $carta->id]);

                if ($linhaFatura->delete()) {
                    Yii::$app->session->setFlash("success", 'Carta removida do Carrinho');
                } else {
                    Yii::$app->session->setFlash("error", 'Operação falhada');
                }
            }
        } else {
            Yii::$app->session->setFlash('error', 'É necessária autenticação para esta funcionalidade');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}

