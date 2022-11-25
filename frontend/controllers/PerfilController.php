<?php

namespace frontend\controllers;

use common\models\Perfil;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class PerfilController extends Controller
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
                    'only' => ['index'],
                    'rules' => [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest){
            return $this->redirect(['site/login']);
        }
        $user = User::findOne(Yii::$app->user->id);
        $perfil = Perfil::findOne(['user_id' => $user->id]);

        if($this->request->isPost){
            $perfil->load($this->request->post());
            if ($perfil->save()){
                Yii::$app->session->setFlash('success', 'Perfil Atualizado!');
            }
            else {
                Yii::$app->session->setFlash('error', 'Ocorreu um erro no processo, tente novamente.');
            }
        }

        return $this->render('index', [
            'user' => $user,
            'perfil' => $perfil,
        ]);
    }

}
