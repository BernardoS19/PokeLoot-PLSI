<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Elemento $model */

$this->title = 'Create Elemento';
$this->params['breadcrumbs'][] = ['label' => 'Elementos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elemento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
