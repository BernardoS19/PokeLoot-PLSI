<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Carta $model */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Cartas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="carta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'imagem_id' => $model->imagem_id, 'tipo_id' => $model->tipo_id, 'elemento_id' => $model->elemento_id, 'colecao_id' => $model->colecao_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'imagem_id' => $model->imagem_id, 'tipo_id' => $model->tipo_id, 'elemento_id' => $model->elemento_id, 'colecao_id' => $model->colecao_id], [
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
            'id',
            'nome',
            'preco',
            'descricao',
            'verificado',
            'imagem_id',
            'tipo_id',
            'elemento_id',
            'colecao_id',
        ],
    ]) ?>

</div>
