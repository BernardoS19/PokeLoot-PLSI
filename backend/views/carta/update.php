<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Carta $model */

$this->title = 'Update Carta: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Cartas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'imagem_id' => $model->imagem_id, 'tipo_id' => $model->tipo_id, 'elemento_id' => $model->elemento_id, 'colecao_id' => $model->colecao_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="carta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
