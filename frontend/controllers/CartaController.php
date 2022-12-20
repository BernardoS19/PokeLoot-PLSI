<?php

namespace frontend\controllers;

use common\models\Carta;
use yii\data\Pagination;
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
        $query = Carta::find();
        $count = clone $query;
        $paginas = new Pagination(['totalCount' => $count->count(), 'pageSize' => 9]);

        if(!isset($_GET['nome']))
        {
            $cartas = $query->offset($paginas->offset)->limit($paginas->limit)->orderBy('id DESC')->all();
        }
        else {
            $pesquisa = null;
            if(isset($_GET['nome'])){
                $nome = $_GET['nome'];
                if($pesquisa!= null){
                    $pesquisa += ['nome' => $nome];
                }else{
                    $pesquisa = ['like','carta.nome','%'.$nome.'%', false];
                }
            }
            $cartas = $query->offset($paginas->offset)->limit($paginas->limit)->where($pesquisa)->orderBy('id DESC')->all();
        }

        return $this->render('index', [
            'cartas' => $cartas,
            'paginas' => $paginas,
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
