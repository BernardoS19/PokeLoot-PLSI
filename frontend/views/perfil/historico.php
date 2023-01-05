<?php

/** @var yii\web\View $this */
/** @var $faturas */

use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

$this->title = 'Histórico de Aquisições';
?>
<div class="p-4"></div>
<section>
    <div class="container">
        <h2>Histórico de Aquisições</h2>
        <br>
        <?php
        if (empty($faturas)){
            echo '<p>Ainda não existem aquisições feitas por si.</p>';
        }
        foreach ($faturas as $fatura){
        ?>
        <h5>Aquisição em: <b><?= date('d/m/Y H:i', strtotime($fatura->data)) ?></b></h5>
            <br>
            <?php
            foreach ($fatura->linhasFatura as $linha){
            ?>
                <div class="row">
                    <div class="col-2 col-md-2">
                        <a href="<?= \yii\helpers\Url::toRoute("carta/detalhes?cartaId=".$linha->carta->id) ?>">
                            <?= Html::img('@imgurl' . '/' . $linha->carta->imagem->nome, ['height' => 220]) ?>
                        </a>
                    </div>
                    <div class="col-10 col-md-10">
                        <p>
                            <h6><?= $linha->carta->nome ?></h6>
                        </p>

                        <p>
                            <?= $linha->preco ?> €
                        </p>

                        <?= $linha->verificado ? '<p><span class="verificado"><i class="fa fa-check-circle-o"></i> Verificado</span></p>':'' ?>

                        <p>
                            Coleção: <?= $linha->carta->colecao->nome ?>
                        </p>
                    </div>
                </div>
                <br>
            <?php
            }
            ?>
            <hr class="p-2">
        <?php
        }
        ?>
    </div>
</section>

