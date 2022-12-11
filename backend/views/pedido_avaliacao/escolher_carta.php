<?php

use common\models\Carta;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\CartaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var int $userId */

$this->title = 'Cartas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carta-index">
    <br>
    <h3>Escolher uma Carta</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                'attribute' => 'elemento_id',
                'label' => 'Elemento',
                'value' => function($model){
                    return $model->elemento->nome;
                },
            ],
            [
                'attribute' => 'colecao_id',
                'label' => 'Coleção',
                'value' => function($model){
                    return $model->colecao->nome;
                },
            ],
            'descricao',
            [
                'class' => ActionColumn::class,
                'template' => '{view} &nbsp {create}',
                'buttons' => [
                    'view' => function ($url) {
                        return Html::a('Ver Carta', $url, ['class' => 'btn btn-info']);
                    },
                    'create' => function ($url) use ($userId) {
                        if (\common\models\User::findOne(Yii::$app->user->getId())->getUserRole() == 'avaliador'){
                            if ($userId == Yii::$app->user->getId()){
                                return Html::a('Escolher', $url.'&user_id='.$userId, ['data' => ['method' => 'post'], 'class' => 'btn btn-success']);
                            } else {
                                return ''; //ERRO
                            }
                        }
                        return Html::a('Escolher', $url.'&user_id='.$userId, ['data' => ['method' => 'post'], 'class' => 'btn btn-success']);
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
