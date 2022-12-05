<?php

use app\models\UploadForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Carta $model */
/** @var UploadForm $uploadForm */

$this->title = 'Create Carta';
$this->params['breadcrumbs'][] = ['label' => 'Cartas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'uploadForm' => $uploadForm,
    ]) ?>

</div>
