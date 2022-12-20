<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Avaliadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <br>
    <h3>Escolha um Avaliador</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'username',
            [
                'label' => 'Role',
                //'attribute' => 'userRole',
                'value' => 'userRole',
            ],
            'email:email',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'status',
            //'created_at',
            //'updated_at',
            //'verification_token',
            [
                'class' => ActionColumn::class,
                'template' => '{escolher_carta}',
                'buttons' => [
                    'escolher_carta' => function($url){
                        return Html::a('Escolher', $url, ['class' => 'btn btn-success']);
                    }
                ],

                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

</div>
