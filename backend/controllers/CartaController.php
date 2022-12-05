<?php

namespace backend\controllers;

use app\models\UploadForm;
use common\models\Carta;
use common\models\CartaSearch;
use common\models\Imagem;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * CartaController implements the CRUD actions for Carta model.
 */
class CartaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['admin', 'avaliador'],
                    ],
                    [
                        'actions' => ['update', 'update_imagem', 'delete'],
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
        ];
    }

    /**
     * Lists all Carta models.
     *
     * @return string|Response
     */
    public function actionIndex()
    {
        if (!\Yii::$app->user->can('readCarta')) {
            return $this->redirect(['site/index']);
        }

        $searchModel = new CartaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Carta model.
     * @param int $id ID
     * @param int $imagem_id Imagem ID
     * @param int $tipo_id Tipo ID
     * @param int $elemento_id Elemento ID
     * @param int $colecao_id Colecao ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $imagem_id, $tipo_id, $elemento_id, $colecao_id)
    {
        if (!\Yii::$app->user->can('readCarta')) {
            return $this->redirect(['site/index']);
        }


        return $this->render('view', [
            'model' => $this->findModel($id, $imagem_id, $tipo_id, $elemento_id, $colecao_id),
        ]);
    }

    /**
     * Creates a new Carta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        if (!\Yii::$app->user->can('createCarta')) {
            return $this->redirect(['site/index']);
        }

        $uploadForm = new UploadForm();
        $imagem = new Imagem();
        $carta = new Carta();

        if ($this->request->isPost) {
            if ($carta->load($this->request->post())) {
                $uploadForm->imagemCarta = UploadedFile::getInstance($uploadForm, 'imagemCarta');
                $nomeImagem = date('mdyhis');
                if ($uploadForm->upload($nomeImagem)) {
                    $imagem->nome = $nomeImagem . '.' . $uploadForm->imagemCarta->extension;
                    if ($imagem->save()) {
                        $carta->verificado = 0;
                        $carta->imagem_id = $imagem->id;
                        $carta->save();

                        return $this->redirect(['view', 'id' => $carta->id, 'imagem_id' => $carta->imagem_id, 'tipo_id' => $carta->tipo_id, 'elemento_id' => $carta->elemento_id, 'colecao_id' => $carta->colecao_id]);
                    }
                }
            }
        }

        return $this->render('create', [
            'model' => $carta,
            'uploadForm' => $uploadForm,
        ]);
    }

    /**
     * Updates an existing Carta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $imagem_id Imagem ID
     * @param int $tipo_id Tipo ID
     * @param int $elemento_id Elemento ID
     * @param int $colecao_id Colecao ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $imagem_id, $tipo_id, $elemento_id, $colecao_id)
    {
        if (!\Yii::$app->user->can('updateCarta')) {
            return $this->redirect(['site/index']);
        }

        $model = $this->findModel($id, $imagem_id, $tipo_id, $elemento_id, $colecao_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'imagem_id' => $model->imagem_id, 'tipo_id' => $model->tipo_id, 'elemento_id' => $model->elemento_id, 'colecao_id' => $model->colecao_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Carta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $imagem_id Imagem ID
     * @param int $tipo_id Tipo ID
     * @param int $elemento_id Elemento ID
     * @param int $colecao_id Colecao ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate_imagem($id, $imagem_id, $tipo_id, $elemento_id, $colecao_id)
    {
        if (!\Yii::$app->user->can('updateCarta')) {
            return $this->redirect(['site/index']);
        }

        $uploadForm = new UploadForm();
        $carta = $this->findModel($id, $imagem_id, $tipo_id, $elemento_id, $colecao_id);

        $imagem = new Imagem();
        $imagemAnterior = Imagem::findOne($imagem_id);
        if ($this->request->isPost) {
            $uploadForm->imagemCarta = UploadedFile::getInstance($uploadForm, 'imagemCarta');
            $nomeImagem = date('mdyhis');

            if ($uploadForm->upload($nomeImagem)) {
                $imagem->nome = $nomeImagem . '.' . $uploadForm->imagemCarta->extension;

                if ($imagem->save()) {
                    $carta->imagem_id = $imagem->id;
                    $carta->save();

                    if(file_exists(\Yii::getAlias('@common') . '/images/' . $imagemAnterior->nome)) {
                        unlink(\Yii::getAlias('@common') . '/images/' . $imagemAnterior->nome);
                    }
                    $imagemAnterior->delete();

                    return $this->redirect(['view', 'id' => $carta->id, 'imagem_id' => $carta->imagem_id, 'tipo_id' => $carta->tipo_id, 'elemento_id' => $carta->elemento_id, 'colecao_id' => $carta->colecao_id]);
                }
            }
        }

        return $this->render('update_imagem', [
            'model' => $carta,
            'uploadForm' => $uploadForm,
        ]);
    }


    /**
     * Deletes an existing Carta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param int $imagem_id Imagem ID
     * @param int $tipo_id Tipo ID
     * @param int $elemento_id Elemento ID
     * @param int $colecao_id Colecao ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $imagem_id, $tipo_id, $elemento_id, $colecao_id)
    {
        if (!\Yii::$app->user->can('deleteCarta')) {
            return $this->redirect(['site/index']);
        }

        $carta = $this->findModel($id, $imagem_id, $tipo_id, $elemento_id, $colecao_id);

        $imagem = Imagem::findOne($imagem_id);
        if(file_exists(\Yii::getAlias('@common') . '/images/' . $imagem->nome)) {
            unlink(\Yii::getAlias('@common') . '/images/' . $imagem->nome);
        }
        $carta->delete();
        $imagem->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Carta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param int $imagem_id Imagem ID
     * @param int $tipo_id Tipo ID
     * @param int $elemento_id Elemento ID
     * @param int $colecao_id Colecao ID
     * @return Carta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $imagem_id, $tipo_id, $elemento_id, $colecao_id)
    {
        if (($model = Carta::findOne(['id' => $id, 'imagem_id' => $imagem_id, 'tipo_id' => $tipo_id, 'elemento_id' => $elemento_id, 'colecao_id' => $colecao_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
