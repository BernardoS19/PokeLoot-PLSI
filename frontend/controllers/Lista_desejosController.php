<?php

namespace frontend\controllers;

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
            $listadesejos=new Lista_desejo();
            $listadesejos->user_id= $user;
            $listadesejos->carta_id=$cartaId;

            if($listadesejos->save()){
                Yii::$app->session->setFlash("success",'Carta adicionada à Lista de Desejos');
            }else
                Yii::$app->session->setFlash("error",'Carta ja foi adicionada aos favoritos');
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