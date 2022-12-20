<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Pedido_avaliacao $model */

$this->title = 'Alterar preço da carta: ' . $model->carta->nome;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos de Avaliação', 'url' => ['index_avaliador']];
$this->params['breadcrumbs'][] = ['label' => $model->carta->nome, 'url' => ['view', 'user_id' => $model->user_id, 'carta_id' => $model->carta_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pedido-avaliacao-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
