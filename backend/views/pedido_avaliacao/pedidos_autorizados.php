<?php

use common\models\Pedido_avaliacao;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\Pedido_avaliacaoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pedidos de Avaliação';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-avaliacao-index">

    <p>
        <!-- Consultar pedidos por autorizar -->
        <?= Html::a('Pedidos por autorizar', ['index_admin'], ['class' => 'btn btn-info']) ?>

        <!-- Consultar a lista de avaliações feitas -->
        <?= Html::a('Pedidos que aguardam avaliação', ['cartas_avaliadas'], ['class' => 'btn btn-info']) ?>
    </p>
    <br>
    <p>
        <!-- Criar um pedido de avaliação como admin -->
        <?= Html::a('Criar Pedido Avaliação', ['escolher_avaliador'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <h3>Pedidos autorizados a aguardar avaliação</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'user',
                'label' => 'Avaliador',
                'value' => function($model) {
                    return $model->user->username . ' | ' . $model->user->email;
                },
            ],
            [
                'attribute' => 'carta',
                'label' => 'Carta',
                'value' => 'carta.nome',
            ],
            [
                'attribute' => 'carta',
                'label' => 'Coleção',
                'value' => 'carta.colecao.nome'
            ],
            [
                'attribute' => 'carta',
                'label' => 'Preço Atual',
                'value' => function($model) {
                    return $model->carta->preco . ' €';
                },
            ],

            [
                'class' => ActionColumn::class,
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url) {
                        return Html::a('Ver Carta', $url, ['class' => 'btn btn-info']);
                    },
                ],

                'urlCreator' => function ($action, Pedido_avaliacao $model, $key, $index, $column) {
                    if ($action == 'view'){
                        return Url::toRoute(['carta/view', 'id' => $model->carta->id, 'imagem_id' => $model->carta->imagem_id, 'tipo_id' => $model->carta->tipo_id, 'elemento_id' => $model->carta->elemento_id, 'colecao_id' => $model->carta->colecao_id]);
                    }
                    return Url::toRoute([$action, 'user_id' => $model->user_id, 'carta_id' => $model->carta_id]);
                }
            ],
        ],
    ]); ?>


</div>
