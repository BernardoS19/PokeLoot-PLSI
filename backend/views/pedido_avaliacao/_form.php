<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Pedido_avaliacao $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pedido-avaliacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'carta_id')->textInput() ?>

    <?= $form->field($model, 'autorizado')->textInput() ?>

    <?= $form->field($model, 'data_avaliacao')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
