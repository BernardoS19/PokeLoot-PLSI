<?php

use common\models\Evento;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\EventoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Evento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'data',
                'label' => 'Data',
                'value' => function($model){
                    return date('d/m/Y', strtotime($model->data));
                }
            ],
            'descricao',
            [
                'attribute' => 'carta_id',
                'label' => 'Carta',
                'value' => function($model){
                    return $model->carta->nome;
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Evento $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'carta_id' => $model->carta_id]);
                 }
            ],
        ],
    ]); ?>


</div>
