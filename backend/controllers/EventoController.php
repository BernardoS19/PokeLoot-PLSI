<?php

namespace backend\controllers;

use common\models\CartaSearch;
use common\models\Evento;
use common\models\EventoSearch;
use common\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

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
                            'actions' => ['index', 'view', 'escolher_carta', 'escolher_carta_update', 'create', 'update', 'delete'],
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
     * @return string|Response
     */
    public function actionIndex()
    {
        if (!\Yii::$app->user->can('readEvento')) {
            return $this->redirect(['site/index']);
        }

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
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $carta_id)
    {
        if (!\Yii::$app->user->can('readEvento')) {
            return $this->redirect(['site/index']);
        }

        return $this->render('view', [
            'model' => $this->findModel($id, $carta_id),
        ]);
    }

    /**
     * O admin escolhe uma carta para associar a um novo evento
     * @return string|Response
     */
    public function actionEscolher_carta()
    {
        if (!\Yii::$app->user->can('createEvento')) {
            return $this->redirect(['site/index']);
        }

        $searchModel = new CartaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, 'sem_evento');

        return $this->render('escolher_carta', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Evento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param int $id Carta ID
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        if (!\Yii::$app->user->can('createEvento')) {
            return $this->redirect(['site/index']);
        }

        if (Evento::find()->where(['carta_id' => $id])->one()){
            return $this->redirect(['site/index']);
        }

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
            'carta_id' => $id,
        ]);
    }

    /**
     * O admin escolhe uma carta para associar a um novo evento
     * @return string|Response
     */
    public function actionEscolher_carta_update($id, $carta_id)
    {
        if (!\Yii::$app->user->can('updateEvento')) {
            return $this->redirect(['site/index']);
        }

        $searchModel = new CartaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('escolher_carta_update', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id,
            'carta_id' => $carta_id,
        ]);
    }

    /**
     * Updates an existing Evento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $carta_id Carta ID
     * @param int $carta_nova Carta ID nova
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $carta_id, $carta_nova)
    {
        if (!\Yii::$app->user->can('updateEvento')) {
            return $this->redirect(['site/index']);
        }

        $model = $this->findModel($id, $carta_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'carta_id' => $model->carta_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'carta_nova' => $carta_nova,
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
        if (!\Yii::$app->user->can('deleteEvento')) {
            return $this->redirect(['site/index']);
        }

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
