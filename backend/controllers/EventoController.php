<?php

namespace backend\controllers;

use common\models\Evento;
use common\models\EventoSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventoController implements the CRUD actions for Evento model.
 */
class EventoController extends Controller
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
                            'actions' => ['index', 'view', 'create', 'update', 'delete'],
                            'allow' => true,
                            'roles' => ['admin'],
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
            ]
        );
    }

    /**
     * Lists all Evento models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EventoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Evento model.
     * @param int $id ID
     * @param int $carta_id Carta ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $carta_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $carta_id),
        ]);
    }

    /**
     * Creates a new Evento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Evento();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'carta_id' => $model->carta_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Evento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $carta_id Carta ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $carta_id)
    {
        $model = $this->findModel($id, $carta_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'carta_id' => $model->carta_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Evento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param int $carta_id Carta ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $carta_id)
    {
        $this->findModel($id, $carta_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Evento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param int $carta_id Carta ID
     * @return Evento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $carta_id)
    {
        if (($model = Evento::findOne(['id' => $id, 'carta_id' => $carta_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
