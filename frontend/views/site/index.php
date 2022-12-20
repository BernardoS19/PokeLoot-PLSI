<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var $cartas */
/** @var $avaliadas */

$this->title = 'PokéLoot';
?>
<div class="site-index">
    <div class="p-4">
    </div>

    <div class="body-content">

        <!-- RECENTEMENTE ADICIONADAS -->
        <!-- single product slide -->
        <div class="single-product-slider">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h2>Recentemente Adicionadas</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- single product -->
                    <?php
                    foreach ($cartas as $carta){
                    ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="single-product">
                                <a href="<?= \yii\helpers\Url::toRoute("carta/detalhes?cartaId=".$carta->id) ?>">
                                    <?= Html::img(Yii::getAlias('@imgurl') .'/'. $carta->imagem->nome) ?>
                                </a>
                                <div class="product-details">
                                    <h6><?= $carta->nome ?></h6>
                                    <div class="price">
                                        <h6><?= $carta->preco ?></h6>
                                    </div>
                                    <div class="prd-bottom">
                                        <?= Html::a('<span><i class="fa fa-shopping-cart"></i> </span>',['carrinho/adicionar?cartaId='.$carta->id], ['data'=>['method'=>'post'],'class'=>'social-info']) ?>

                                        <?= Html::a('<span><i class="fa fa-star" aria-hidden="true"></i></span>',['lista_desejos/adicionar?cartaId='.$carta->id], ['data'=>['method'=>'post'],'class'=>'social-info']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- end product Area -->


        <!-- RECENTEMENTE AVALIADAS -->
        <!-- single product slide -->
        <br>
        <div class="single-product-slider">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h2>Recentemente Avaliadas</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- single product -->
                    <?php
                    foreach ($avaliadas as $avaliada){
                    ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="single-product">
                                <a href="<?= \yii\helpers\Url::toRoute("carta/detalhes?cartaId=".$avaliada->carta->id) ?>">
                                    <?= Html::img(Yii::getAlias('@imgurl') .'/'. $avaliada->carta->imagem->nome) ?>
                                </a>
                                <div class="product-details">
                                    <h6><?= $avaliada->carta->nome ?></h6>
                                    <div class="price">
                                        <h6><?= $avaliada->carta->preco ?></h6>
                                    </div>
                                    <div class="prd-bottom">
                                        <?= Html::a('<span><i class="fa fa-shopping-cart"></i> </span>',['carrinho/adicionar?cartaId='.$avaliada->carta->id], ['data'=>['method'=>'post'],'class'=>'social-info']) ?>
                                         <?= Html::a('<span><i class="fa fa-star" aria-hidden="true"></i></span>',['lista_desejos/adicionar?cartaId='.$avaliada->carta->id], ['data'=>['method'=>'post'],'class'=>'social-info']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

