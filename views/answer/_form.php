<?php

use app\models\Theme;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$items = Theme::find()
    ->select(['name'])
    ->indexBy('id')
    ->column();
/** @var yii\web\View $this */
/** @var app\models\Answer $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="answer-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'id_user')->hiddenInput(['value'=>Yii::$app->user->getId()])->label(false) ?>

    <?= $form->field($model, 'id_theme')->dropdownList($items,
    ['prompt'=>'Выберите категорию']
); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
