<?php

namespace frontend\controllers;

use common\models\Carta;
use yii\filters\VerbFilter;
use yii\web\Controller;


class CartaController extends Controller
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

    // Página de Catálogo
    public function actionIndex()
    {
        if(!isset($_GET['nome'])){
            $cartas = Carta::find()->orderBy('id DESC')->all();
        }else{
            $pesquisa = null;
            if(isset($_GET['nome'])){
                $nome = $_GET['nome'];
                if($pesquisa!= null){
                    $pesquisa += ['nome' => $nome];
                }else{
                    $pesquisa = ['like','carta.nome','%'.$nome.'%', false];
                }
            }
            $cartas= Carta::find()->where($pesquisa)->orderBy('id DESC')->all();
        }



        return $this->render('index', [
            'cartas' => $cartas,
        ]);
    }

    // Página de detalhes da Carta
    public function actionDetalhes($cartaId)
    {
        $carta = Carta::findOne(['id'=>$cartaId]);

        return $this->render('detalhes',[
            'carta' => $carta,
        ]);
    }

}
