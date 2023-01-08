<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
?>

<section class="login_box_area section_gap">
    <div class="container">
        <div class="login_form_inner col-md-">
            <h3>Login</h3>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="col-md-12 form-group">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            </div>
            <div class="col-md-12 form-group">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
            <div class="col-md-12 form-group">
                <div class="creat_account">
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <?= Html::submitButton('Login', ['class' => 'genric-btn primary primary-btn radius', 'name' => 'login-button', 'id' => 'login-btn']) ?>
            </div>
            <?php ActiveForm::end(); ?>
            <div style="padding:30px">
                <p> Ainda não está registado?
                    <span style="padding-left: 20px"><?= Html::a('Criar uma Conta', ['site/signup'], ['class' => 'genric-btn primary radius medium']) ?></span>
                </p>
            </div>
        </div>
    </div>
</section>
