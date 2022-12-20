<?php

use common\models\Carta;
use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\CartaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var int $userId */

$this->title = 'Criar Pedido de Avaliação';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carta-index">
    <br>
    <h3>Escolher uma Carta</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nome',
            [
                'attribute' => 'preco',
                'label' => 'Preço',
                'value' => function($model){
                    return $model->preco . ' €';
                }
            ],
            [
                'attribute' => 'tipo_id',
                'label' => 'Tipo',
                'value' => function($model){
                    return $model->tipo->nome;
                },
            ],
            [
                'attribute' => 'colecao_id',
                'label' => 'Coleção',
                'value' => function($model){
                    return $model->colecao->nome;
                },
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{view} &nbsp {create}',
                'buttons' => [
                    'view' => function ($url) {
                        return Html::a('Ver Carta', $url, ['class' => 'btn btn-info']);
                    },
                    'create' => function ($url) use ($userId) {
                        if (User::findOne(Yii::$app->user->getId())->getUserRole() == 'avaliador'){
                            if ($userId == Yii::$app->user->getId()){
                                return Html::a('Escolher', $url.'&user_id='.$userId, ['data' => ['method' => 'post'], 'class' => 'btn btn-success']);
                            } else {
                                return ''; //ERRO
                            }
                        } elseif (User::findOne(Yii::$app->user->getId())->getUserRole() == 'admin') {
                            return Html::a('Escolher', $url . '&user_id=' . $userId, ['data' => ['method' => 'post'], 'class' => 'btn btn-success']);
                        } else {
                            return ''; //ERRO
                        }
                    },
                ],
                'urlCreator' => function ($action, Carta $model, $key, $index, $column) {
                    if ($action == 'view'){
                        return Url::toRoute(['carta/view', 'id' => $model->id, 'imagem_id' => $model->imagem_id, 'tipo_id' => $model->tipo_id, 'elemento_id' => $model->elemento_id, 'colecao_id' => $model->colecao_id]);
                    }
                    return Url::toRoute([$action, 'id' => $model->id, 'imagem_id' => $model->imagem_id, 'tipo_id' => $model->tipo_id, 'elemento_id' => $model->elemento_id, 'colecao_id' => $model->colecao_id]);
                }
            ],
        ],
    ]); ?>


</div>
