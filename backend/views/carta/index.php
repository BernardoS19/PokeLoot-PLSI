<?php

use common\models\Carta;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\CartaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cartas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Carta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                'attribute' => 'verificado',
                'label' => 'Verificado',
                'value' => function($model){
                    if ($model->verificado){
                        return 'Sim';
                    } else {
                        return 'Não';
                    }
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Carta $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'imagem_id' => $model->imagem_id, 'tipo_id' => $model->tipo_id, 'elemento_id' => $model->elemento_id, 'colecao_id' => $model->colecao_id]);
                 }
            ],
        ],
    ]); ?>


</div>
