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
        foreach ($faturas as $fatura){
        ?>
        <p>
            Aquisição em:<h6><?= date('d/m/Y H:i', strtotime($fatura->data)) ?></h6>
            <br>
            <?php
            foreach ($fatura->linhasFatura as $linha){
            ?>
                <div class="row">
                    <div class="col-4 col-md-4">
                        <?= Html::img('@imgurl' . '/' . $linha->carta->imagem->nome) ?>
                    </div>
                    <div class="col-8 col-md-8">
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
        </p>
        <?php
        }
        ?>
    </div>
</section>

