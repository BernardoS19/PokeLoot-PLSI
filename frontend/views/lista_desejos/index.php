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
                            <?= \yii\bootstrap5\Html::a('<i class="fa fa-remove"></i> Remover',['lista_desejos/remover?cartaId='.$item->carta_id], ['data'=>['method'=>'post'],'class'=>'btn btn-sm btn-danger']) ?>
                            <h5></h5>
                            <a href="<?= \yii\helpers\Url::toRoute("carta/detalhes?cartaId=".$item->carta->id) ?>">
                                <?= Html::img(Yii::getAlias('@imgurl') .'/'. $item->carta->imagem->nome) ?>
                            </a>
                            <div class="product-details">
                                <h6><?= $item->carta->nome ?> <?php echo $item->carta->verificado ? '<i class="fa fa-check-circle-o verificado"></i>':''; ?></h6>
                                <div class="price">
                                    <h6><?= $item->carta->preco ?> €</h6>
                                </div>
                                <div class="prd-bottom align-items-center">
                                    <?= \yii\bootstrap5\Html::a('<span><i class="fa fa-shopping-cart"></i> Adicionar ao Carrinho</span> ', ['carrinho/adicionar?cartaId='.$item->carta_id], ['data' => ['method'=>'post'],'class' => 'genric-btn primary-btn rounded']) ?>
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