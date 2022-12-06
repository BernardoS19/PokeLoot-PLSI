<?php

namespace frontend\controllers;

use common\models\Lista_desejo;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class Lista_desejosController extends Controller
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
        $user= Yii::$app->user->identity->id;
        $lista_desejo = Lista_desejo::find()->where(['user_id'=>$user])->all();
        return $this->render('index',['lista_desejo'=>$lista_desejo]);
    }

}
