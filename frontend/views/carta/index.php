<?php

/** @var yii\web\View $this */
/** @var $cartas */
/** @var $paginas */
/** @var $tipos */
/** @var $elementos */
/** @var $colecoes */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Catálogo';
?>
<div class="p-4"></div>

<div class="container">
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
            <div class="sidebar-categories">
                <div class="head">Pesquisar por Coleção:</div>
                <ul class="main-categories">
                    <?php foreach ($colecoes as $colecao) { ?>
                        <li class="main-nav-list">
                            <?= Html::a($colecao->nome.'<span class="number">(' .count($colecao->cartas). ')</span>', ['carta/index', 'colecao' => $colecao->id]) ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-7">
            <!-- Start Filter Bar -->
            <div class="filter-bar d-flex flex-wrap align-items-center">
                <form class="row" method="get">
                    <div class="sorting col">
                        <select name="tipo">
                            <option id="">Tipos</option>
                            <?php foreach ($tipos as $tipo) { ?>
                                <option id="<?= $tipo->id ?>" value="<?= $tipo->id ?>"><?= $tipo->nome ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="sorting col">
                        <select name="elemento">
                            <option id="">Elementos</option>
                            <?php foreach ($elementos as $elemento) { ?>
                                <option id="<?= $elemento->id ?>" value="<?= $elemento->id ?>"><?= $elemento->nome ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="sorting col">
                        <select name="verificado">
                            <option>Verificado</option>
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                    <div class="sorting mr-auto col">
                        <button type="submit" class="genric-btn rounded">Filtrar</button>
                    </div>
                </form>
                <div class="sorting mr-auto"></div>
                <?php
                    echo LinkPager::widget([
                        'pagination' => $paginas,
                    ]);
                ?>
            </div>
            <!-- End Filter Bar -->
            <!-- Start Best Seller -->
            <section class="lattest-product-area pb-40 category-list">
                <div class="row">
                    <?php
                        foreach ($cartas as $carta){
                    ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="single-product">
                                <a href="<?= \yii\helpers\Url::toRoute("carta/detalhes?cartaId=".$carta->id) ?>">

                                    <?= Html::img(Yii::getAlias('@imgurl') .'/'. $carta->imagem->nome) ?>
                                </a>

                                <div class="product-details">
                                    <h6><?= $carta->nome ?> <?php echo $carta->verificado ? '<i class="fa fa-check-circle-o verificado"></i>':''; ?></h6>
                                    <div class="price">
                                        <h6><?= $carta->preco ?> €</h6>
                                    </div>
                                    <div class="prd-bottom">
                                        <div class="card_area d-flex align-items-center">
                                            <?= \yii\bootstrap5\Html::a('<span><i class="fa fa-shopping-cart"></i> </span>',['carrinho/adicionar?cartaId='.$carta->id], ['data'=>['method'=>'post'],'class'=>'social-info']) ?>

                                            <?= \yii\bootstrap5\Html::a('<span><i class="fa fa-star"></i></span>',['lista_desejos/adicionar?cartaId='.$carta->id], ['data'=>['method'=>'post'],'class'=>'social-info']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </section>
            <!-- End Best Seller -->
            <!-- Start Filter Bar -->
            <div class="filter-bar d-flex flex-wrap align-items-center">
                <div class="sorting mr-auto">
                </div>
                <?php
                    echo LinkPager::widget([
                        'pagination' => $paginas,
                    ]);
                ?>
            </div>
            <!-- End Filter Bar -->
        </div>
    </div>
</div>

<script>
    const botoesDisabled = document.getElementsByClassName('disabled');
    for (let i = 0; i < botoesDisabled.length; i++){
        botoesDisabled[i].style.display = 'none';
    }
</script>
