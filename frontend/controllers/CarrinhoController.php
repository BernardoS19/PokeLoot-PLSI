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

        $user= Yii::$app->user->identity->id;
        $linhafatura = null;

        if(Fatura::findOne(['user_id'=>$user,'pago'=>0,'data'=>null])!= null)
        {
            if(!empty(Fatura::findOne(['user_id'=>$user,'pago'=>0,'data'=>null])->linhasFatura)){
                $fatura = Fatura::findOne(['user_id' => $user, 'pago' => 0, 'data' => null]);
                $linhafatura = LinhaFatura::find()->where(['fatura_id'=>$fatura->id])->all();
            }
        }


        return $this->render('index',['linhasfatura'=>$linhafatura]);
    }

    public function actionAdicionar($cartaId){
        $user=\Yii::$app->user->identity->id;
        $carta = Carta::findOne($cartaId);

        if($carta != null && $user != null){

           if(Fatura::findOne(['user_id'=>$user,'pago'=>0,'data'=>null])!= null){
               $carrinho = Fatura::findOne(['user_id'=> $user,'pago'=>0,'data'=>null]);
           }else{
               $carrinho = new Fatura();
               $carrinho->user_id=$user;
               $carrinho->save();

           }
            $linhafatura = new LinhaFatura();
            $linhafatura->fatura_id=$carrinho->id;
            $linhafatura->carta_id=$cartaId;
            $linhafatura->preco=$carta->preco;

            if($linhafatura->save()){
                Yii::$app->session->setFlash("success",'Carta adicionada ao Carrinho de compras');
            }else
                Yii::$app->session->setFlash("error",'Carta ja foi adicionada ao carrinho');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
    public function actionRemover($cartaId){
        $user=\Yii::$app->user->identity->id;
        $carta = Carta::findOne($cartaId);
        if($carta != null && $user != null){
            $fatura=Fatura::findOne(['user_id'=> $user,'pago'=>0,'data'=>null]);
            $linhaFatura=LinhaFatura::findOne(['fatura_id'=>$fatura->id,'carta_id'=>$carta->id]);
            if($linhaFatura->delete()){
                Yii::$app->session->setFlash("success",'Carta removida do Carrinho');
            }else
                Yii::$app->session->setFlash("error",'Operação falhada');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}

