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
        <?= Html::a('Alterar Imagem', ['update_imagem', 'id' => $model->id, 'imagem_id' => $model->imagem_id, 'tipo_id' => $model->tipo_id, 'elemento_id' => $model->elemento_id, 'colecao_id' => $model->colecao_id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'imagem_id' => $model->imagem_id, 'tipo_id' => $model->tipo_id, 'elemento_id' => $model->elemento_id, 'colecao_id' => $model->colecao_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'imagem_id' => $model->imagem_id, 'tipo_id' => $model->tipo_id, 'elemento_id' => $model->elemento_id, 'colecao_id' => $model->colecao_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="d-flex">
        <div class="p-3">
            <?= Html::img('@imgurl' . '/' . $model->imagem->nome); ?>
        </div>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'nome',
                [
                    'attribute' => 'preco',
                    'label' => 'Preço',
                    'value' => $model->preco . ' €',
                ],
                'descricao',
                [
                    'attribute' => 'verificado',
                    'label' => 'Verificado',
                    'value' => function ($model) {
                        if ($model->verificado){
                            return 'Sim';
                        } else {
                            return 'Não';
                        }
                    }
                ],
                [
                    'attribute' => 'tipo_id',
                    'label' => 'Tipo',
                    'value' => $model->tipo->nome,
                ],
                [
                    'attribute' => 'elemento_id',
                    'label' => 'Elemento',
                    'value' => $model->elemento->nome,
                ],
                [
                    'attribute' => 'colecao_id',
                    'label' => 'Coleção',
                    'value' => $model->colecao->nome,
                ],
            ],
        ]) ?>
    </div>
</div>