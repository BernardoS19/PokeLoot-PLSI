<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;

$this->title = 'PokéLoot - Perfil';
?>
<div class="site-index">
    <div class="p-4">
    </div>

    <section>
        <div class="container">
            <h2>Perfil</h2>
            <br>
            <div class="order_d_inner">
                <div class="details_item">
                    <h4 class="tab2"><?= $user->username ?></h4>
                    <ul class="list">
                        <li><h6>Email: <span class="text-black"><?= $user->email ?></span></h6></li>
                    </ul>
                </div>
                <?= Html::a('Logout', ['site/logout'], ['data' => ['method' => 'post'], 'class' => 'genric-btn primary radius medium']) ?>
            </div>
            <div class=""></div>
        </div>
    </section>

</div>
