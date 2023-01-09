<?php
/** @var $totalCartas */
/** @var $proximoEvento */
/** @var $pedidosRecebidos */

$this->title = 'Página Inicial';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">
    <div class="row">
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-4">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Total de Cartas Adicionadas',
                'number' => $totalCartas.' <small>cartas</small>',
                'icon' => 'fa fa-sticky-note',
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Data do Próximo Evento',
                'number' => date('d/m/Y', strtotime($proximoEvento->data)),
                'icon' => 'fas fa-calendar-alt',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Pedidos Recebidos para Autorizar',
                'number' => $pedidosRecebidos,
                'theme' => 'gradient-warning',
                'icon' => 'far fa-copy',
            ]) ?>
        </div>
    </div>


</div>