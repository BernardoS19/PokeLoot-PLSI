<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Pedido_avaliacao $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pedido-avaliacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'valor_avaliado')->textInput(['maxlength' => true, 'type' => 'number', 'step' => 0.01]) ?>

    <div class="form-group">
        <?= Html::submitButton('Alterar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
