<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Evento $model */
/** @var int $carta_nova */

$this->title = 'Update Evento: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'carta_id' => $model->carta_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="evento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'carta_nova' => $carta_nova,
    ]) ?>

</div>
