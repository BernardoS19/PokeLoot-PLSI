<?php
namespace backend\modules\api\controllers;

use common\models\Fatura;
use common\models\User;
use common\models\Carta;
use Yii;
use yii\db\Query;
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

    public function actionCompradas()
    {
        $authkey = Yii::$app->request->headers["auth"];

        if (User::findByAuthKey($authkey)) {
            $user = User::findByAuthKey($authkey);
            $faturasPagas = Fatura::find()->where(['user_id' => $user->id, 'pago' => 1])->orderBy('data DESC')->all();

            $compradas = array();
            foreach ($faturasPagas as $fatura){
                foreach ($fatura->linhasFatura as $linha){
                    $myObj = new \stdClass();
                    $myObj->id = $linha->carta->id;
                    $myObj->imagem = base64_encode(file_get_contents(Yii::getAlias('@imgurl').'/'.$linha->carta->imagem->nome));
                    $myObj->nome = $linha->carta->nome;
                    $myObj->descricao = $linha->carta->descricao;
                    $myObj->tipo = $linha->carta->tipo->nome;
                    $myObj->elemento = $linha->carta->elemento->nome;
                    $myObj->colecao = $linha->carta->colecao->nome;
                    array_push($compradas, $myObj);
                }
            }
            return $compradas;
        }
        else {
            $myObj = new \stdClass();
            $myObj->error = "Erro. Utilizador não existe.";
            return $myObj;
        }
    }
}