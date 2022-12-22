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
        <!-- Consultar todos os pedidos associados ao avaliador -->
        <?= Html::a('Consultar Pedidos autorizados', ['index_avaliador'], ['class' => 'btn btn-info']) ?>
    </p>
    <br>
    <p>
        <?= Html::a('Criar Pedido Avaliação', ['escolher_carta', 'id' => Yii::$app->user->identity->getId()], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <br>
    <h3>Pedidos autorizados por avaliar</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'carta',
                'label' => 'Carta',
                'value' => 'carta.nome',
            ],
            [
                'attribute' => 'pedido_avaliacao',
                'label' => 'Estado',
                'value' => 'estado',
            ],
            [
                'attribute' => 'pedido_avaliacao',
                'label' => 'Preço Avaliado',
                'value' => function($model){
                    if (!$model->valor_avaliado){
                        return '- €';
                    } else {
                        return $model->valor_avaliado . ' €';
                    }
                },
            ],
            [
                'attribute' => 'data_avaliacao',
                'label' => 'Data da Avaliação',
                'value' => function($model){
                    if ($model->data_avaliacao != null){
                        return date('d/m/Y H:i', strtotime($model->data_avaliacao));
                    } else {
                        return '---';
                    }

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
                        return Url::toRoute(['carta/view', 'id' => $model->carta_id, 'imagem_id' => $model->carta->imagem_id, 'tipo_id' => $model->carta->tipo_id, 'elemento_id' => $model->carta->elemento_id, 'colecao_id' => $model->carta->colecao_id]);
                    }
                    return Url::toRoute([$action, 'user_id' => $model->user_id, 'carta_id' => $model->carta_id]);
                 }
            ],
        ],
    ]); ?>


</div>
