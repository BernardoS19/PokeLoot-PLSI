<?php

namespace backend\controllers;

use common\models\Pedido_avaliacao;
use common\models\Pedido_avaliacaoSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * Pedido_avaliacaoController implements the CRUD actions for Pedido_avaliacao model.
 */
class Pedido_avaliacaoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['index_admin', 'autorizar', 'cancelar', 'delete'],
                            'allow' => true,
                            'roles' => ['admin'],
                        ],
                        [
                            'actions' => ['index_avaliador', 'finalizar', 'update', 'delete'],
                            'allow' => true,
                            'roles' => ['avaliador'],
                        ],
                    ],
                    'denyCallback' => function ($rule, $action) {
                        return $this->redirect(['site/index']);
                    }
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ],
        );
    }

    /** - Admin
     * Página index do admin.
     *
     * @return string
     */
    public function actionIndex_admin()
    {
        $searchModel = new Pedido_avaliacaoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, 'por_autorizar');

        return $this->render('index_admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /** - Avaliador
     * Página index para o avaliador.
     *
     * @return string
     */
    public function actionIndex_avaliador()
    {
        $searchModel = new Pedido_avaliacaoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, 'autorizado');

        return $this->render('index_avaliador', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /** - Admin
     * Autoriza um pedido
     * @return string|Response
     * @param int $user_id User ID
     * @param int $carta_id Carta ID
     */
    public function actionAutorizar($user_id, $carta_id)
    {
        $pedido = Pedido_avaliacao::findOne(['user_id' => $user_id, 'carta_id' => $carta_id]);
        $pedido->estado = 'Autorizado';
        $pedido->save();

        return $this->redirect(['pedido_avaliacao/index_admin']);
    }

    /** - Admin
     * Cancela o pedido
     * @return string|Response
     * @param int $user_id User ID
     * @param int $carta_id Carta ID
     */
    public function actionCancelar($user_id, $carta_id)
    {
        $pedido = Pedido_avaliacao::findOne(['user_id' => $user_id, 'carta_id' => $carta_id]);
        $pedido->estado = 'Cancelado';
        $pedido->save();

        return $this->redirect(['pedido_avaliacao/index_admin']);
    }

    /** - Avaliador
     * Finaliza uma avaliação
     * @return string|Response
     * @param int $user_id User ID
     * @param int $carta_id Carta ID
     */
    public function actionFinalizar($user_id, $carta_id)
    {
        $pedido = Pedido_avaliacao::findOne(['user_id' => $user_id, 'carta_id' => $carta_id]);

        if ($pedido->estado == 'Autorizado') {
            if ($pedido->valor_avaliado != null) {

                $pedido->data_avaliacao = date('Y-m-d H:i:s');
                $pedido->estado = 'Avaliado';

                $pedido->carta->preco = $pedido->valor_avaliado;

                $pedido->carta->save();
                $pedido->save();
            }
        }

        return $this->redirect(['pedido_avaliacao/index_avaliador']);
    }


    /**
     * Displays a single Pedido_avaliacao model.
     * @param int $user_id User ID
     * @param int $carta_id Carta ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user_id, $carta_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id, $carta_id),
        ]);
    }

    /**
     * Creates a new Pedido_avaliacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Pedido_avaliacao();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'user_id' => $model->user_id, 'carta_id' => $model->carta_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Faz update do preço para a avaliação da carta.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $user_id User ID
     * @param int $carta_id Carta ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($user_id, $carta_id)
    {
        $model = $this->findModel($user_id, $carta_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index_avaliador', 'user_id' => $model->user_id, 'carta_id' => $model->carta_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pedido_avaliacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $user_id User ID
     * @param int $carta_id Carta ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($user_id, $carta_id)
    {
        $this->findModel($user_id, $carta_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pedido_avaliacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $user_id User ID
     * @param int $carta_id Carta ID
     * @return Pedido_avaliacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $carta_id)
    {
        if (($model = Pedido_avaliacao::findOne(['user_id' => $user_id, 'carta_id' => $carta_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
