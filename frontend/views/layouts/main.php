<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\helpers\Url;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
<!--                    <a class="navbar-brand logo_h" href="#"><img src="../../web/img/logo.png" alt=""></a>-->
                    <h2>PokéLoot</h2>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <!-- Navbar links -->
                            <!-- Pagina Inicial -->
                            <li class="nav-item">
                                <?= Html::a('Início', ['/site/index'], ['class' => 'nav-link']) ?>
                            </li>
                            <!-- Teste -->
                            <li class="nav-item">
                                <?= Html::a('Contact(teste)', ['/site/contact'], ['class' => 'nav-link']) ?>
                            </li>
                            <!-- CATÁLOGO -->
                            <li class="nav-item">
                                <?= Html::a('Catálogo', ['/site/catalogo'], ['class' => 'nav-link']) ?>
                            </li>
                            <!-- EVENTOS -->
                            <li class="nav-item">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                   aria-expanded="false">Eventos</a>
                            </li>

                            <li class="nav-item">

                            </li>

                            <!-- LOGIN -->
                            <li class="nav-item">
                                <?php
                                if (Yii::$app->user->isGuest){
                                    echo Html::a('Login', ['/site/login'], ['class' => 'nav-link']);
                                } else {
                                    echo Html::a('Perfil', ['site/perfil'], ['class' => 'nav-link']);
                                }
                                ?>
                            </li>
                        </ul>
                        <!-- ICONS -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Pesquisa -->
                            <li class="nav-item">
                                <button class="search"><span id="search"><i class="fa fa-search" aria-hidden="true"></i></span></button>
                            </li>
                            <?php
                                if (!Yii::$app->user->isGuest){
                            ?>
                                <!-- Lista de desejos -->
                                <li class="nav-item"><a href="<?= Url::toRoute('site/desejos') ?>" class="cart"><span><i class="fa fa-star" aria-hidden="true"></i></span></a></li>
                                <!-- Carrinho -->
                                    <li class="nav-item"><a href="<?= Url::toRoute('site/carrinho') ?>" class="cart"><span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span></a></li>
                            <?php
                                }
                            ?>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <!-- SEARCH INPUT -->
        <div class="search_input" id="search_input_box">
            <div class="container">
                <form class="d-flex justify-content-between">
                    <input type="text" class="form-control" id="search_input" placeholder="Procurar">
                    <button type="submit" class="btn"></button>
                    <span id="close_search" title="Close Search"><i class="fa fa-close" aria-hidden="true"></i></span>
                </form>
            </div>
        </div>
    </header>
    <!-- End Header Area -->


    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>


    <!-- start footer Area -->
    <footer class="footer-area section_gap">
        <div class="container">
            <div class="row">
            </div>
            <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
                <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>  Downloaded from <a href="https://themeslab.org/" target="_blank">Themeslab</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
