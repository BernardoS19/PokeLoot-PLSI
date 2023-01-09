<?php

namespace backend\controllers;

use common\models\Carta;
use common\models\Evento;
use common\models\LoginForm;
use common\models\Pedido_avaliacao;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UrlManager;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin', 'avaliador'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $totalCartas = Carta::find()->count();

        $dataAtual = date('Y-m-d');
        $proximoEvento = Evento::find()->where(['>', 'data', $dataAtual])->orderBy('data ASC')->one();

        $pedidosRecebidos = Pedido_avaliacao::find()->where(['estado' => 'Por Autorizar'])->count();

        return $this->render('index',[
            'totalCartas' => $totalCartas,
            'proximoEvento' => $proximoEvento,
            'pedidosRecebidos' => $pedidosRecebidos,
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        $this->layout = 'blank';

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if ( $model->isAllowed()) {
                return $this->goBack();
            }
            else {
                //$this->redirect(Yii::getAlias('@frontend')."/web/site/login");
            }
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);

    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
