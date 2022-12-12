<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Pedido_avaliacao $model */

$this->title = 'Criar Pedido de Avaliação';
$this->params['breadcrumbs'][] = ['label' => 'Pedidos Avaliação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-avaliacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
