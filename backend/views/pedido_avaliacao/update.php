<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Pedido_avaliacao $model */

$this->title = 'Update Pedido Avaliacao: ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Pedido Avaliacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'user_id' => $model->user_id, 'carta_id' => $model->carta_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pedido-avaliacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
