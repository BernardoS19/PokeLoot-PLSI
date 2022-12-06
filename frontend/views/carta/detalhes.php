<?php

/** @var yii\web\View $this */
/** @var \common\models\Carta $carta */

use yii\helpers\Html;

$this->title = '*nome da carta*';
?>
<div class="p-4"></div>

<!--================Single Product Area =================-->
<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div class="imagem-detalhes">
                    <?= Html::img('@imgurl' . '/'.  $carta->imagem->nome) ?>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3><?= $carta->nome?></h3>
                    <h2><?= $carta->preco?></h2>
                    <ul class="list">
                        <li><span>Tipo: </span><?= $carta->tipo->nome?></a></li>
                        <li><span>Elemento: </span><?= $carta->elemento->nome?></a></li>
                    </ul>
                    <p><?=$carta->descricao?></p>

                    <div class="card_area d-flex align-items-center">
                        <a class="primary-btn" href="#">Add to Cart</a>
                        <a class="icon_btn" href="<?= \yii\helpers\Url::toRoute('lista_desejos/')?>"><i class="fa fa-star"></i></a>
                        <?= \yii\bootstrap5\Html::a('',['lista_desejos/']) ?>
                        <a class="icon_btn" href="#"><i class="lnr lnr lnr-heart"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Single Product Area =================-->