    <?php

/** @var yii\web\View $this */
/** @var  $linhasfatura */
/** @var  $precoTotal */

use yii\helpers\Html;
use yii\helpers\Url;

    $this->title = 'Carrinho';
?>
<div class="p-4"></div>

<section class="">
    <div class="container">
        <h2>Carrinho de Compras</h2>
        <br>
        <div class="cart_inner">
            <?php
            if($linhasfatura!= null){
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Carta</th>
                        <th scope="col">Preço</th>
                    </tr>
                    </thead>

                    <?php
                    foreach ($linhasfatura as $linhafatura){
                    ?>

                    <tbody>
                    <tr>
                        <td>
                            <div class="media">
                                <div class="d-flex">
                                    <a href="<?= Url::toRoute("carta/detalhes?cartaId=".$linhafatura->carta->id) ?>">
                                        <?= Html::img(Yii::getAlias('@imgurl') . '/' . $linhafatura->carta->imagem->nome) ?>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4><?= $linhafatura->carta->nome ?></h4>
                                    <?php
                                    if ($linhafatura->carta->verificado){
                                        echo '<span class="verificado"><i class="fa fa-check-circle-o"></i> Verificado</span>';
                                    }
                                    ?>
                                    <br>
                                    <p><?= $linhafatura->carta->descricao ?></p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <h5><?= $linhafatura->carta->preco ?> €</h5>
                        </td>
                        <td>
                            <?= \yii\bootstrap5\Html::a('<i class="fa fa-remove"></i> Remover',['carrinho/remover?cartaId='.$linhafatura->carta_id], ['data'=>['method'=>'post'],'class'=>'btn btn-danger btn-sm']) ?>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td>
                            <h4>Total</h4>
                        </td>
                        <td style="white-space: nowrap">
                            <h4><?= $precoTotal ?> €</h4>
                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>
                            <div class="checkout_btn_inner d-flex align-items-end">
                                <a class="primary-btn rounded" href="#">Comprar</a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <?php
            }else {
                echo "Carrinho vazio";
            }
            ?>
        </div>
    </div>
</section>

