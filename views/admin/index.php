<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Личный кабинет Админа';

?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'description',
            'date',
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function ($item) {
                    return '<img alt="" width="200px" src="../../web/uploads/' . $item['image'] . '">';
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($item) {
                    if ($item['status'] === 0) return 'Заявка на рассмотрение';
                    if ($item['status'] === 1) return 'Заявка принята';
                    if ($item['status'] === 2) return 'Заявка отклонена';
                }
            ],
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function ($item) {
                    return '<img alt="" width="200px" src="../../web/uploads/' . $item['after_image'] . '">';
                }
            ],
            'after_description',
        ],
    ]); ?>


</div>
