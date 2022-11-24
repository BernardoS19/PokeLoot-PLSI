<?php

/** @var yii\web\View $this */

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
                <!-- single product -->
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <?= Html::img(Yii::getAlias('@imgurl') . '/' . 'carta_teste.png') ?>
                        <div class="product-details">
                            <h6>Carta_teste1</h6>
                            <div class="price">
                                <h6>1,20 €</h6>
                            </div>
                            <div class="prd-bottom">
                                <a href="" class="social-info">
                                    <span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single product -->
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <?= Html::img(Yii::getAlias('@imgurl') . '/' . 'carta_teste.png') ?>
                        <div class="product-details">
                            <h6>Carta_teste1</h6>
                            <div class="price">
                                <h6>1,20 €</h6>
                            </div>
                            <div class="prd-bottom">
                                <a href="" class="social-info">
                                    <span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single product -->
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <?= Html::img(Yii::getAlias('@imgurl') . '/' . 'carta_teste.png') ?>
                        <div class="product-details">
                            <h6>Carta_teste1</h6>
                            <div class="price">
                                <h6>1,20 €</h6>
                            </div>
                            <div class="prd-bottom">
                                <a href="" class="social-info">
                                    <span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single product -->
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <?= Html::img(Yii::getAlias('@imgurl') . '/' . 'carta_teste.png') ?>
                        <div class="product-details">
                            <h6>Carta_teste1</h6>
                            <div class="price">
                                <h6>1,20 €</h6>
                            </div>
                            <div class="prd-bottom">
                                <a href="" class="social-info">
                                    <span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end product Area -->