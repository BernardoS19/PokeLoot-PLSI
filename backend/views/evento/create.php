<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Evento $model */
/** @var int $carta_id */

$this->title = 'Create Evento';
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'carta_nova' => $carta_id,
    ]) ?>

</div>
