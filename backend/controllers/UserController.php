<?php

namespace backend\controllers;

use common\models\Perfil;
use Yii;
use common\models\User;
use app\models\UserSearch;
use frontend\models\SignupForm;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     *
     * @return string|Response
     */
    public function actionIndex()
    {
        if (!\Yii::$app->user->can('readUser')) {
            return $this->redirect(['site/index']);
        }

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, ['admin', 'avaliador']);
        $dataProviderCliente = $searchModel->search($this->request->queryParams, 'cliente');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderCliente' => $dataProviderCliente,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!\Yii::$app->user->can('readUser')) {
            return $this->redirect(['site/index']);
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        if (!\Yii::$app->user->can('createUser')) {
            return $this->redirect(['site/index']);
        }

        $signup = new SignupForm();

        if ($this->request->isPost) {
            $signup->load($this->request->post());
            if ($signup->validate()) {
                $signup->signup();
                $user = User::findOne(['email' => $signup->email]);

                $authManager = Yii::$app->authManager;

                $role = $authManager->getRole($user->getUserRole());

                $authManager->revoke($role, $user->id);

                $novaRole = $authManager->getRole(addslashes($_POST["roles"]));
                $authManager->assign($novaRole, $user->id);

                Yii::$app->session->setFlash('success', 'O utilizador foi criado com sucesso');

                return $this->redirect(['view', 'id' => $user->id]);
            }
        }

        return $this->render('create', [
            'signup' => $signup,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!\Yii::$app->user->can('updateUser')) {
            return $this->redirect(['site/index']);
        }

        $model = $this->findModel($id);

        if ($this->request->isPost) {
            $model->load($this->request->post());

            $authManager = Yii::$app->authManager;

            $role = $authManager->getRole($model->getUserRole());

            $authManager->revoke($role, $model->id);

            $novaRole = $authManager->getRole(addslashes($_POST["roles"]));
            $authManager->assign($novaRole, $model->id);

            $model->username = $_POST['User']['username'];
            $model->email = $_POST['User']['email'];

            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->id, 'status' => 'success']);
            } else {
                return $this->redirect(['view', 'id' => $model->id, 'status' => 'failed']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!\Yii::$app->user->can('deleteUser')) {
            return $this->redirect(['site/index']);
        }

        $user = User::findOne($id);
        $authManager = Yii::$app->authManager;
        $role = $authManager->getRole($user->getUserRole());
        $authManager->revoke($role, $id);

        $perfil = Perfil::findOne(['id_user' => $user->id]);

        $perfil->delete();
        $user->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
