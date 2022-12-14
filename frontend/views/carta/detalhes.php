<?php

/** @var yii\web\View $this */
/** @var \common\models\Carta $carta */

use yii\helpers\Html;

$this->title = $carta->nome.' | '.$carta->colecao->nome;
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
                    <?php
                    if ($carta->verificado){
                        echo '<h5 class="verificado"><i class="fa fa-check-circle-o"></i> Verificado</h5>';
                    }
                    ?>

                    <h2><?= $carta->preco?> €</h2>
                    <ul class="list">
                        <li><span>Tipo: </span><?= $carta->tipo->nome?></a></li>
                        <li><span><?php echo $carta->tipo->nome == 'Treinador' ? 'Género:' : 'Elemento:'?> </span><?= $carta->elemento->nome?></a></li>
                        <li><span>Coleção: </span><?= $carta->colecao->nome?></a></li>
                    </ul>
                    <p><?=$carta->descricao?></p>

                    <div class="card_area d-flex align-items-center">
                        <?= \yii\bootstrap5\Html::a('Adicionar ao Carrinho',['carrinho/adicionar?cartaId='.$carta->id], ['data'=>['method'=>'post'],'class'=>'primary-btn']) ?>
                        <?= \yii\bootstrap5\Html::a('<i class="fa fa-star"></i>',['lista_desejos/adicionar?cartaId='.$carta->id], ['data'=>['method'=>'post'],'class'=>'icon_btn']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Single Product Area =================-->