<?php

/** @var yii\web\View $this */
/** @var common\models\Lista_desejo $lista_desejo */
use yii\bootstrap5\Html;

$this->title = 'Lista de Desejos';
?>
<div class="p-4"></div>

<div class="body-content">

    <div class="single-product-slider">
        <div class="container">
            <h2>Lista de Desejos</h2>
            <br>
            <div class="row">
                <div class="col-lg-6 text-center">
                </div>
            </div>
            <div class="row">

                <?php
                foreach ($lista_desejo as $item){
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <?= Html::img(Yii::getAlias('@imgurl') . '/' . $item->carta->imagem->nome) ?>
                            <div class="product-details">
                                <h6><?= $item->carta->nome ?></h6>
                                <div class="price">
                                    <h6><?= $item->carta->preco ?></h6>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                        <span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                                    </a>

                                       <span></span><?= \yii\bootstrap5\Html::a('<i class="fa fa-star"></i>',['lista_desejos/remover?cartaId='.$item->carta_id], ['data'=>['method'=>'post'],'class'=>'icon_btn']) ?>

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