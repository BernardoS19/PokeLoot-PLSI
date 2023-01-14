<?php
namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use yii\web\Request;

class CartaController extends ActiveController
{
    public $modelClass = 'common\models\Carta';
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['view'], $actions['delete'], $actions['update']);
        return $actions;
    }
    public function actionView($id)
    {
        $cartamodel = new $this->modelClass;

        return $cartamodel::findOne($id);

    }
    public function actionUpdate($id)
    {
        $request = \Yii::$app->request->post();
        $cartamodel = new $this->modelClass;
        $ids = $cartamodel->findOne($id);
        if ($ids) {
            if (isset($request['nome'])) {
                $ids->nome = $request['nome'];
            }
            if (isset($request['preco'])) {
                $ids->preco = $request['preco'];
            }
            if (isset($request['descricao'])) {
                $ids->descricao = $request['descricao'];
            }
            $ids->save();
            return ['success' => 'dados alterados'];
        }
        return new \Yii\web\NotAcceptableHttpException('nao encontrado');

    }
    public function actionDelete($id)
    {
        $cartamodel = new $this->modelClass;
        $ids = $cartamodel->findOne($id);
        if ($ids) {
            $ids->delete();
            return ['success' => 'carta deleted'];
        }
        return new \Yii\web\NotAcceptableHttpException('nao encontrado');
    }
}