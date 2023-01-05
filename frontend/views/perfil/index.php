<?php

/** @var yii\web\View $this */
/** @var $user */
/** @var $perfil */

use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

$this->title = 'Perfil';
?>
<div class="p-4"></div>
<section>
    <div class="container">
        <h2>Perfil</h2>
        <br>
        <div class="order_d_inner">

            <h4>Username: <?= $user->username ?></h4>
            <h5>Email: <span class="text-black"><?= $user->email ?></span></h5>

            <?= Html::a('Ver Histórico de Aquisições', ['perfil/historico'], ['class' => 'genric-btn info rounded']) ?>
            <br>
            <br>
            <?php $form = ActiveForm::begin(); ?>
            <div class="p-1">
                <?= $form->field($perfil,'nome')->textInput(['maxlength' => true, 'disabled' => true, 'style'=>'width: 65%']); ?>
            </div>
            <div class="p-1">
                <?= $form->field($perfil,'morada')->textInput(['maxlength' => true, 'disabled' => true, 'style'=>'width: 65%']); ?>
            </div>
            <div class="p-1">
                <?= $form->field($perfil,'cod_postal')->textInput(['maxlength' => true, 'disabled' => true, 'style'=>'width: 65%']); ?>
            </div>
            <div class="p-1">
                <?= $form->field($perfil,'telefone')->textInput(['maxlength' => 9, 'disabled' => true, 'style'=>'width: 65%']); ?>
            </div>
            <div>
                <a id="editarForm" onclick="editar()" href="#" class="genric-btn primary radius">Editar</a>
            </div>
            <div>
                <?= Html::submitButton('Guardar Alterações', ['class' => 'genric-btn success radius', 'id' => 'guardar', 'style' => 'display: none']) ?>
            </div>

            <?php ActiveForm::end(); ?>

            <br>
            <?= Html::a('Logout', ['site/logout'], ['data' => ['method' => 'post'], 'class' => 'genric-btn danger radius']) ?>
        </div>
        <div class=""></div>
    </div>
</section>

<script>
    function editar() {
        document.getElementById("perfil-nome").disabled = false;
        document.getElementById("perfil-morada").disabled = false;
        document.getElementById("perfil-cod_postal").disabled = false;
        document.getElementById("perfil-telefone").disabled = false;
        document.getElementById("editarForm").style.display = 'none';
        document.getElementById("guardar").style.display = 'block';
    }
</script>
