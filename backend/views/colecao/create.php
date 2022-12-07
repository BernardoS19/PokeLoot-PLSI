<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Colecao $model */

$this->title = 'Criar Coleção';
$this->params['breadcrumbs'][] = ['label' => 'Colecaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="colecao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
