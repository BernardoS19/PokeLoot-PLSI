<?php

use common\models\Carta;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\CartaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var int $id */
/** @var int $carta_id */


$this->title = 'Editar Evento';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carta-index">
    <br>
    <h3>Escolher uma Carta para alterar o evento</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'nome',
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
                'template' => '{view} &nbsp {update}',
                'buttons' => [
                    'view' => function ($url) {
                        return Html::a('Ver Carta', $url, ['class' => 'btn btn-info']);
                    },
                    'update' => function ($url) use ($id, $carta_id){
                        return Html::a('Escolher', ['evento/update', 'id' => $id, 'carta_id' => $carta_id, 'carta_nova' => explode('&', explode('=', $url,2)[1], 2)[0]], ['data' => ['method' => 'post'], 'class' => 'btn btn-success']);
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
