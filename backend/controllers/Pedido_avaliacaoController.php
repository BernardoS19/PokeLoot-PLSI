<?php

namespace backend\controllers;

use app\models\UserSearch;
use common\models\CartaSearch;
use common\models\Pedido_avaliacao;
use common\models\Pedido_avaliacaoSearch;
use common\models\User;
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
                            'actions' => ['index_admin', 'escolher_avaliador', 'autorizar', 'cancelar'],
                            'allow' => true,
                            'roles' => ['admin'],
                        ],
                        [
                            'actions' => ['index_avaliador', 'finalizar', 'update'],
                            'allow' => true,
                            'roles' => ['avaliador'],
                        ],
                        [
                            'actions' => ['escolher_carta', 'create', 'delete'],
                            'allow' => true,
                            'roles' => ['admin', 'avaliador'],
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

        if ($pedido->estado == 'Autorizado' && $user_id == Yii::$app->user->identity->getId()) {
            if ($pedido->valor_avaliado != null) {

                $pedido->data_avaliacao = date('Y-m-d H:i:s');
                $pedido->estado = 'Avaliado';

                $pedido->carta->preco = $pedido->valor_avaliado;
                $pedido->carta->verificado = 1;

                $pedido->carta->save();
                $pedido->save();
            }
        }

        return $this->redirect(['pedido_avaliacao/index_avaliador']);
    }

    /** - Admin
     * O admin escolhe um avaliador para associar a um novo pedido
     *
     * @return string|Response
     */
    public function actionEscolher_avaliador()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, 'avaliador');

        return $this->render('escolher_avaliador', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /** - Admin | Avaliador
     * O admin ou avaliador escolhe uma carta para associar a um novo pedido
     * @param int $id User ID
     * @return string|Response
     */
    public function actionEscolher_carta($id)
    {
        $searchModel = new CartaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, 'sem_pedido');//todo: lá no model search

        return $this->render('escolher_carta', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'userId' => $id,
        ]);
    }

    /** - Admin | Avaliador
     * Botão para criar o pedido após a escolha da carta
     * @param $user_id
     * @param $id //carta_id
     * @return string|Response
     */
    public function actionCreate($user_id, $id)
    {
        $pedido = new Pedido_avaliacao();
        $pedido->user_id = $user_id;
        $pedido->carta_id = $id;
        if (User::findOne(Yii::$app->user->getId())->getUserRole() == 'admin'){
            $pedido->estado = 'Autorizado';
        } elseif (User::findOne(Yii::$app->user->getId())->getUserRole() == 'avaliador'){
            $pedido->estado = 'Por Autorizar';
        }
        $pedido->valor_avaliado = null;
        $pedido->data_avaliacao = null;
        $pedido->save();

        return $this->redirect(['site/index']);
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
