<?php

namespace frontend\controllers;

use common\models\Fatura;
use common\models\Lista_desejo;
use Yii;
use common\models\Carta;
use common\models\User;
use yii\filters\VerbFilter;
use yii\web\Controller;

class Lista_desejosController extends Controller
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
        $lista_desejo = Lista_desejo::find()->where(['user_id'=>$user])->all();
        return $this->render('index',['lista_desejo'=>$lista_desejo]);
    }

    public function actionAdicionar($cartaId){
        $user=\Yii::$app->user->identity->id;
        $carta = Carta::findOne($cartaId);
        if($carta != null && $user != null){
            if (empty(Fatura::find()->join('LEFT JOIN','linha_fatura', 'linha_fatura.fatura_id = fatura.id')->filterWhere(['linha_fatura.carta_id' => $carta->id, 'fatura.pago' => 1])->all()))
            {
                $listadesejos = new Lista_desejo();
                $listadesejos->user_id = $user;
                $listadesejos->carta_id = $cartaId;

                if ($listadesejos->save()) {
                    Yii::$app->session->setFlash('success', 'Carta adicionada à Lista de Desejos');
                } else {
                    Yii::$app->session->setFlash('error', 'Carta ja foi adicionada aos favoritos');
                }
            } else {
                Yii::$app->session->setFlash('warning', 'Esta carta já foi comprada por si.');
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionRemover($cartaId){
        $user=\Yii::$app->user->identity->id;
        $carta = Carta::findOne($cartaId);
        if($carta != null && $user != null){
            $listadesejos=Lista_desejo::find()->where(['user_id'=> $user,'carta_id'=>$cartaId])->one();

            if($listadesejos->delete()){
                Yii::$app->session->setFlash("success",'Carta removida da Lista de Desejos');
            }else
                Yii::$app->session->setFlash("error",'Operação falhada');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}