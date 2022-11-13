<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var frontend\models\SignupForm $signup */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($signup, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($signup, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($signup, 'password')->passwordInput(['maxlength' => true]) ?>

    <label for="roles">Role</label>
    <select name="roles" id="roles" class="form-control">
        <?php
            $roles = Yii::$app->authManager->getRoles();
            foreach($roles as $role) {
        ?>
            <option value="<?= $role->name ?>"><?= $role->name ?></option>
        <?php
            }
        ?>
    </select>
    <br>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
