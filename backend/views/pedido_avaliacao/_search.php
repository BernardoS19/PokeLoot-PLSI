<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Pedido_avaliacaoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pedido-avaliacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'carta_id') ?>

    <?= $form->field($model, 'estado') ?>

    <?= $form->field($model, 'valor_avaliado') ?>

    <?= $form->field($model, 'data_avaliacao') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
