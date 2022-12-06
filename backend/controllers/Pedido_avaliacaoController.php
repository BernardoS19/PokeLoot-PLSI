<?php

namespace backend\controllers;

use common\models\Pedido_avaliacao;
use common\models\Pedido_avaliacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
     * Lists all Pedido_avaliacao models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new Pedido_avaliacaoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
     * @return string|\yii\web\Response
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
     * Updates an existing Pedido_avaliacao model.
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
