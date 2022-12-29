<?php

/** @var yii\web\View $this */
/** @var $evento common\models\Evento */
/** @var $map dosamigos\google\maps\Map */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Eventos';
?>
<div class="p-4"></div>

<section class="">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post row">
                    <div class="col-lg-12">
                        <div class="feature-img">
                            <?= $map->display() ?>
                        </div>
                    </div>
                    <div class="col-lg-3  col-md-3">
                        <div class="blog_info text-right">
                            <ul class="blog_meta list">
                                <li><b><?= date('d/m/Y', strtotime($evento->data)) ?> <i class="fa fa-calendar"></i></b></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 blog_details">
                        <h2>Próximo Evento</h2>
                        <p class="excert">
                            <?= $evento->descricao ?>
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget author_widget">
                        <p>Carta do Evento</p>
                        <br>
                        <a href="<?= Url::toRoute('carta/detalhes?cartaId='.$evento->carta->id) ?>">
                            <?= Html::img('@imgurl' . '/' . $evento->carta->imagem->nome) ?>
                        </a>

                        <h4><?= $evento->carta->nome ?></h4>

                        <?= $evento->carta->verificado ? '<span class="verificado"><i class="fa fa-check-circle-o"></i> Verificado</span>':'' ?>

                        <p>Coleção: <?= $evento->carta->colecao->nome ?></p>

                        <div class="br"></div>
                    </aside>

                </div>
            </div>
        </div>

    </div>
</section>

