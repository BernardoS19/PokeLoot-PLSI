<?php

use app\models\UploadForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Carta $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="carta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preco')->textInput(['maxlength' => true, 'type' => 'number', 'step' => 0.1]) ?>

    <?= $form->field($model, 'descricao')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'tipo_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Tipo::find()->asArray()->all(), 'id', 'nome')) ?>

    <?= $form->field($model, 'elemento_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Elemento::find()->asArray()->all(), 'id', 'nome')) ?>

    <?= $form->field($model, 'colecao_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Colecao::find()->asArray()->all(), 'id', 'nome')) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
