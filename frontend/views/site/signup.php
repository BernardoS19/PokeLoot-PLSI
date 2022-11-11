<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
?>

<section class="login_box_area section_gap">
    <div class="container">
        <div class="login_form_inner col-md-">
            <h3>Criar uma Conta</h3>
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <div class="col-md-12 form-group">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            </div>
            <div class="col-md-12 form-group">
                <?= $form->field($model, 'email') ?>
            </div>
            <div class="col-md-12 form-group">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>

            <div class="col-md-12 form-group">
                <?= Html::submitButton('Criar Conta', ['class' => 'genric-btn primary primary-btn radius', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
            <div style="padding:30px">
                <p> Já tem uma conta?
                    <span style="padding-left: 20px"><?= Html::a('Entrar', ['site/login'], ['class' => 'genric-btn primary radius medium']) ?></span>
                </p>
            </div>
        </div>
    </div>
</section>


<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
