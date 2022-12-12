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
        /*
        if($this->request->isPost){
            if(isset($_Post['sort'])) {
                $select = $_Post['sort'];
                switch ($select) {
                    case'preco_alto':
                        return $cartas = Carta::find()->orderBy('preco DESC')->all();
                        break;
                    case 'preco_baixo':
                        return $cartas = Carta::find()->orderBy('preco ASC')->all();
                        break;
                    case 'nome':
                        return $cartas = Carta::find()->orderBy('nome DESC')->all();
                        break;
                    default:
                        $cartas = Carta::find()->orderBy('id DESC')->all();
                        return $this->render('index', ['cartas' => $cartas]);
                }
            }
        }
        */
        $cartas = Carta::find()->orderBy('id DESC')->all();

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
