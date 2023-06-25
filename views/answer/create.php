<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Answer $model */

$this->title = 'Добавление заявки';

?>
<div class="answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
