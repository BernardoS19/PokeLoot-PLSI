<?php

namespace backend\controllers;

use common\models\PedidoAvaliacao;
use common\models\PedidoAvaliacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PedidoAvaliacaoController implements the CRUD actions for PedidoAvaliacao model.
 */
class PedidoAvaliacaoController extends Controller
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
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all PedidoAvaliacao models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PedidoAvaliacaoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PedidoAvaliacao model.
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
     * Creates a new PedidoAvaliacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new PedidoAvaliacao();

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
     * Updates an existing PedidoAvaliacao model.
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
            return $this->redirect(['view', 'user_id' => $model->user_id, 'carta_id' => $model->carta_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PedidoAvaliacao model.
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
     * Finds the PedidoAvaliacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $user_id User ID
     * @param int $carta_id Carta ID
     * @return PedidoAvaliacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $carta_id)
    {
        if (($model = PedidoAvaliacao::findOne(['user_id' => $user_id, 'carta_id' => $carta_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
