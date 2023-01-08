<?php

namespace frontend\controllers;

use common\models\LinhaFatura;

use common\models\Lista_desejo;
use common\models\Perfil;
use common\models\User;
use common\models\Carta;
use common\models\Fatura;
use frontend\models\PagamentoForm;
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
                if (empty(Fatura::find()->join('LEFT JOIN','linha_fatura', 'linha_fatura.fatura_id = fatura.id')->filterWhere(['linha_fatura.carta_id' => $carta->id, 'fatura.pago' => 1])->all()))
                {
                    if (Fatura::findOne(['user_id' => $userId, 'pago' => 0, 'data' => null]) != null)
                    {
                        $carrinho = Fatura::findOne(['user_id' => $userId, 'pago' => 0, 'data' => null]);
                    }
                    else {
                        $carrinho = new Fatura();
                        $carrinho->pago = 0;
                        $carrinho->user_id = $userId;
                        $carrinho->save();
                    }
                    $linhafatura = new LinhaFatura();
                    $linhafatura->fatura_id = $carrinho->id;
                    $linhafatura->carta_id = $cartaId;

                    if ($linhafatura->save())
                    {
                        Yii::$app->session->setFlash('success', 'Carta adicionada ao Carrinho de compras');
                    }
                    else {
                        Yii::$app->session->setFlash('error', 'Carta já se encontra no Carrinho');
                    }

                } else {
                    Yii::$app->session->setFlash('warning', 'Esta carta já foi comprada por si.');
                }
            }
        }
        else {
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

    public function actionComprar()
    {
        if (!Yii::$app->user->isGuest)
        {
            $userId = Yii::$app->user->identity->id;
            $perfil = Perfil::findOne(['user_id' => $userId]);
            $fatura = Fatura::findOne(['user_id' => $userId, 'pago' => 0, 'data' => null]);
            $pagamento = new PagamentoForm();

            if ($fatura != null && !empty($fatura->linhasFatura))
            {
                $linhasfatura = LinhaFatura::find()->where(['fatura_id' => $fatura->id])->all();
                $precoTotal = LinhaFatura::find()->where(['fatura_id' => $fatura->id])->join('RIGHT JOIN', 'carta', 'carta.id = linha_fatura.carta_id')->sum('carta.preco');
            }
            else {
                Yii::$app->session->setFlash('error', 'Não é possível efetuar uma compra sem cartas no Carrinho');
                return $this->redirect(['site/index']);
            }

            if ($this->request->isPost)
            {
                $pagamento->load($this->request->post());

                if ($pagamento->validate())
                {
                    if(Lista_desejo::find()->join('INNER JOIN', 'linha_fatura', 'lista_desejo.carta_id = linha_fatura.carta_id')->all()) {
                        $desejos_comprados = Lista_desejo::find()->join('INNER JOIN', 'linha_fatura', 'lista_desejo.carta_id = linha_fatura.carta_id')->all();
                        foreach ($desejos_comprados as $desejo_comprado){
                            $desejo_comprado->delete();
                        }
                    }
                    foreach ($linhasfatura as $linhafatura){
                        $linhafatura->preco = $linhafatura->carta->preco;
                        $linhafatura->verificado = $linhafatura->carta->verificado;
                        $linhafatura->save();
                    }
                    $fatura->pago = 1;
                    $fatura->data = date('Y-m-d H:i:s');
                    $fatura->save();

                    Yii::$app->session->setFlash('success', 'Compra efetuada com sucesso!');
                    return $this->redirect(['site/index']);
                }
                else {
                    Yii::$app->session->setFlash('error', 'Ocorreu um erro, Verifique os dados de pagamento.');
                }
            }
        }
        else {
            Yii::$app->session->setFlash('error', 'É necessária autenticação para esta funcionalidade');
            return $this->redirect(['site/login']);
        }
        return $this->render('comprar', [
            'perfil' => $perfil,
            'linhasfatura' => $linhasfatura,
            'precoTotal' => $precoTotal,
            'pagamento' => $pagamento,
        ]);
    }
}

