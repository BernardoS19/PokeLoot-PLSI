<?php

namespace frontend\controllers;

use common\models\Carta;
use common\models\Colecao;
use common\models\Elemento;
use common\models\Tipo;
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
        $tipos = Tipo::find()->all();
        $elementos = Elemento::find()->all();
        $colecoes = Colecao::find()->all();

        if(!isset($_GET['nome']) && !isset($_GET['tipo']) && !isset($_GET['elemento']) && !isset($_GET['colecao']) && !isset($_GET['verificado']))
        {
            $cartas = $query->orderBy('id DESC')->all();
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
            if (isset($_GET['tipo']) && $_GET['tipo'] != 'Tipos'){
                $tipo = $_GET['tipo'];
                if ($pesquisa != null){
                    $pesquisa += ['tipo_id' => $tipo];
                } else {
                    $pesquisa = ['tipo_id' => $tipo];
                }
            }
            if (isset($_GET['elemento']) && $_GET['elemento'] != 'Elementos'){
                $elemento = $_GET['elemento'];
                if ($pesquisa != null){
                    $pesquisa += ['elemento_id' => $elemento];
                } else {
                    $pesquisa = ['elemento_id' => $elemento];
                }
            }
            if (isset($_GET['colecao'])){
                $colecao = $_GET['colecao'];
                if ($pesquisa != null){
                    $pesquisa += ['colecao_id' => $colecao];
                } else {
                    $pesquisa = ['colecao_id' => $colecao];
                }
            }
            if (isset($_GET['verificado']) && $_GET['verificado'] != 'Verificado'){
                $verificado = $_GET['verificado'];
                if ($pesquisa != null){
                    $pesquisa += ['verificado' => $verificado];
                } else {
                    $pesquisa = ['verificado' => $verificado];
                }
            }

            $comFiltros = $query->where($pesquisa);
            $count = clone $comFiltros;
            $paginas = new Pagination(['totalCount' => $count->count(), 'pageSize' => 9]);
            $cartas = $comFiltros->offset($paginas->offset)->limit($paginas->limit)->orderBy('id DESC')->all();
        }

        return $this->render('index', [
            'cartas' => $cartas,
            'paginas' => $paginas,
            'tipos' => $tipos,
            'elementos' => $elementos,
            'colecoes' => $colecoes,
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
