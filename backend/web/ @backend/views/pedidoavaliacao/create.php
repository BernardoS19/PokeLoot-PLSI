<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PedidoAvaliacao $model */

$this->title = 'Create Pedido Avaliacao';
$this->params['breadcrumbs'][] = ['label' => 'Pedido Avaliacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-avaliacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
