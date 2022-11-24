<?php

namespace frontend\controllers;

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
            return $this->goHome();
        }
        $user = User::findOne(Yii::$app->user->id);

        return $this->render('index', [
            'user' => $user,
        ]);
    }

}
