<?php
namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use yii\web\Request;


class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['view'], $actions['delete'], $actions['update']);
        return $actions;
    }
    public function actionView($id)
    {
        $usermodel = new $this->modelClass;

        return $usermodel::findOne($id);

    }
    public function actionUpdate($id)
    {
        $request = \Yii::$app->request->post();
        $usermodel = new $this->modelClass;
        $ids = $usermodel->findOne($id);
        if ($ids) {
            if (isset($request['nome'])) {
                $ids->nome = $request['nome'];
            }
            if (isset($request['email'])) {
                $ids->preco = $request['email'];
            }
            $ids->save();
            return ['success' => 'dados alterados'];
        }
        return new \Yii\web\NotAcceptableHttpException('nao encontrado');

    }
    public function actionDelete($id)
    {
        $usermodel = new $this->modelClass;
        $ids = $usermodel->findOne($id);
        if ($ids) {
            $ids->delete();
            return ['success' => 'user deleted'];
        }
        return new \Yii\web\NotAcceptableHttpException('nao encontrado');
    }
}
