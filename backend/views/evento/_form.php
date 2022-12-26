<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use ibrarturi\latlngfinder\LatLngFinder;

/** @var yii\web\View $this */
/** @var common\models\Evento $model */
/** @var int $carta_nova */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="evento-form">

    <?php $form = ActiveForm::begin(); ?>



    <label for="evento-data">Data</label>
    <br>
    <input type="date" id="evento-data" name="Evento[data]">
    <br>
    <br>

    <?= $form->field($model, 'descricao')->textarea() ?>

    <br>

    <label>Escolha no mapa o local do Evento</label>
    <div class="row">
        <div class="col-6">
            <?=
            LatLngFinder::widget([
                'latAttribute' => 'evento-latitude',
                'lngAttribute' => 'evento-longitude',
                'mapWidth' => 500,
                'mapHeight' => 450,
                'defaultLat' => 39.399872,
                'defaultLng' => -8.224454,
                'enableZoomField' => false,
                'defaultZoom' => 7,
            ]);
            ?>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label" for="evento-latitude">Latitude</label>
                <input class="form-control" type="text" name="Evento[latitude]" id="evento-latitude">
            </div>
            <div class="form-group">
                <label class="control-label" for="evento-longitude">Longitude</label>
                <input class="form-control" type="text" name="Evento[longitude]" id="evento-longitude">
            </div>
        </div>
    </div>

    <input class="form-control" type="text" value="<?= $carta_nova ?>" name="Evento[carta_id]" id="evento-carta_id" style="display:none">

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
