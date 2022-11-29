<?php

/** @var yii\web\View $this */

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
            <h6>Email: <span class="text-black"><?= $user->email ?></span></h6>

            <?php $form = ActiveForm::begin(); ?>
            <div class="p-1">
                <label for="nome" class="text-black">Nome:</label>
                <br>
                <input type="text" value="<?= $perfil->nome ?>" name="Perfil[nome]" id="nome" disabled>
            </div>
            <div class="p-1">
                <label for="morada" class="text-black">Morada:</label>
                <br>
                <input type="text" value="<?= $perfil->morada ?>" name="Perfil[morada]" id="morada" disabled>
            </div>
            <div class="p-1">
                <label for="cod_postal" class="text-black">Código Postal:</label>
                <br>
                <input type="text" value="<?= $perfil->cod_postal ?>" name="Perfil[cod_postal]" id="cod_postal" disabled>
            </div>
            <div class="p-1">
                <label for="telefone" class="text-black">Contacto Telef.:</label>
                <br>
                <input type="text" value="<?= $perfil->telefone ?>" name="Perfil[telefone]" id="telefone" disabled>
            </div>
            <div>
                <a id="editarForm" onclick="editar()" href="#" class="genric-btn primary radius medium">Editar</a>
            </div>
            <div>
                <?= Html::submitButton('Guardar Alterações', ['class' => 'genric-btn success radius medium', 'id' => 'guardar', 'style' => 'display: none']) ?>
            </div>

            <?php ActiveForm::end(); ?>

            <br>
            <?= Html::a('Logout', ['site/logout'], ['data' => ['method' => 'post'], 'class' => 'genric-btn danger radius medium']) ?>
        </div>
        <div class=""></div>
    </div>
</section>

<script>
    function editar() {
        document.getElementById("nome").disabled = false;
        document.getElementById("morada").disabled = false;
        document.getElementById("cod_postal").disabled = false;
        document.getElementById("telefone").disabled = false;
        document.getElementById("editarForm").style.display = 'none';
        document.getElementById("guardar").style.display = 'block';
    }
</script>
