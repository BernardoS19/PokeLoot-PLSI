<?php

use app\models\UploadForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Carta $model */
/** @var yii\widgets\ActiveForm $form */
/** @var UploadForm $uploadForm */
?>

<div class="carta-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'form-update-imagem']]); ?>

    <?= $form->field($uploadForm, 'imagemCarta')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
