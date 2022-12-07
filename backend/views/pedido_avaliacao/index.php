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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Pedido Avaliação', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            'carta_id',
            'autorizado',
            'data_avaliacao',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pedido_avaliacao $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'user_id' => $model->user_id, 'carta_id' => $model->carta_id]);
                 }
            ],
        ],
    ]); ?>


</div>
