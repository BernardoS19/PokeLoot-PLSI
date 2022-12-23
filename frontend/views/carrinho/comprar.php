<?php
/** @var yii\web\View $this */
/** @var $linhasfatura */
/** @var $precoTotal */
/** @var $perfil */

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


?>
<div class="p-4"></div>
<section>
    <div class="container">
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h4>Dados Pessoais</h4>
                    <br>
                    <div class="row contact_form">
                        <div class="col-md-12 form-group">
                            <label for="nome">Nome</label>
                            <input disabled type="text" value="<?= $perfil->nome ?>" class="form-control" id="nome" name="nome">
                        </div>
                        <div class="col-md-7 form-group">
                            <label for="morada">Morada</label>
                            <input disabled type="text" value="<?= $perfil->morada ?>" class="form-control" id="morada" name="morada">
                        </div>
                        <div class="col-md-2 form-group">
                            <label for="codpostal">Código Postal</label>
                            <input disabled type="text" value="<?= $perfil->cod_postal ?>" class="form-control" id="codpostal" name="codpostal">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="telefone">Contacto Telefónico</label>
                            <input disabled type="text" value="<?= $perfil->telefone ?>" class="form-control" id="telefone" name="telefone">
                        </div>
                        <div class="col-md-3 form-group">
                            <?= Html::a('Atualizar Perfil', ['perfil/index'], ['class' => 'genric-btn primary radius medium']) ?>
                        </div>
                    </div>
                    <h3></h3>
                    <h4>Pagamento</h4>
                    <br>
                    <?php $form = ActiveForm::begin(['options' => ['class' => 'row contact_form']]); ?>
                        <div class="col-md-12 form-group">
                            <label for="nome_cartao">Nome no Cartão</label>
                            <input type="text" class="form-control" id="nome_cartao" name="nome_cartao">
                        </div>
                        <div class="col-md-7 form-group">
                            <label for="numero">Numero do Cartão</label>
                            <input type="text" class="form-control" id="numero" name="numero">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="data_validade">Data de Validade</label>
                            <input type="text" class="form-control" id="data_validade" name="data_validade">
                        </div>
                        <div class="col-md-2 form-group">
                            <label for="ccv">CCV</label>
                            <input type="text" class="form-control" id="ccv" name="ccv">
                        </div>
                        <div class="col-md-3 form-group">
                            <?= Html::submitButton('Finalizar Compra', ['class' => 'genric-btn success radius medium', 'data' => ['confirm' => 'Tem a certeza que quer finalizar a compra?']]) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="col-lg-4">
                    <div class="order_box">
                        <h2>Lista de Itens a comprar</h2>
                        <ul class="list">
                            <li><a href="#">Carta <span>Preço</span></a></li>
                            <?php
                            foreach ($linhasfatura as $linhafatura){
                            ?>
                            <li><a href="<?= Url::toRoute(['carta/detalhes', 'cartaId' => $linhafatura->carta_id]) ?>"><?= $linhafatura->carta->nome . ' | ' . $linhafatura->carta->colecao->nome ?> <span class="last"><?= $linhafatura->carta->preco ?> €</span></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                        <ul class="list list_2">
                            <li><a href="#">Total <span><?= $precoTotal ?> €</span></a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

