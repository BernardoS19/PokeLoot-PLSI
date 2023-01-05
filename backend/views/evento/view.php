<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;

/** @var yii\web\View $this */
/** @var common\models\Evento $model */


$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="evento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['evento/escolher_carta_update', 'id' => $model->id, 'carta_id' => $model->carta_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'carta_id' => $model->carta_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'data',
                'label' => 'Data',
                'value' => function($model){
                    return date('d/m/Y', strtotime($model->data));
                }
            ],
            'descricao',
            [
                'attribute' => 'carta',
                'label' => 'Carta',
                'value' => function($model){
                    return '<div class="row">
                                <div class="col-3 col-md-4">'
                                    .Html::img('@imgurl' . '/' . $model->carta->imagem->nome).
                                '</div>
                                <div class="col-3 col-md-4">
                                    <b>'.$model->carta->nome.'</b>
                                    <br>
                                    Tipo: '.$model->carta->tipo->nome.'
                                    <br>
                                    Elemento: '.$model->carta->elemento->nome.'
                                    <br>
                                    Coleção: '.$model->carta->colecao->nome.'
                                </div>
                            </div>';
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'evento',
                'label' => 'Local',
                'value' => function($model){
                    $coord = new LatLng(['lat' => (float)$model->latitude, 'lng' => (float)$model->longitude]);
                    $map = new Map([
                        'width' => 500,
                        'height' => 450,
                        'center' => $coord,
                        'zoom' => 15,
                    ]);
                    $marker = new Marker([
                        'position' => $coord,
                        'title' => 'Local do Evento',
                    ]);
                    $map->addOverlay($marker);
                    return '<div class="row">
                                <div class="col-6 col-md-7">'
                                .
                                $map->display()
                                .
                                '</div>
                                <div class="col-6 col-md-5">
                                    <b>Latitude:</b> '.$model->latitude.'
                                    <br>
                                    <b>Longitude:</b> '.$model->longitude.'
                                </div>
                            </div>';
                },
                'format' => 'raw',
            ],
        ],
    ]) ?>

</div>
