<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var frontend\models\SignupForm $signup */

$this->title = 'Criar Utilizador';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?= $this->render('_form', [
        'signup' => $signup,
    ]) ?>

</div>
