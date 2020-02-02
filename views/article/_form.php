<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 60])->label('Cím:') ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255])->label('Rövid leírás:') ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6])->label('Szöveg:') ?>

    <?= $form->field($model, 'commentable')->dropDownList(
        [1 => 'Igen', 0 => 'Nem',]
    )->label('Kommentelhető-e:') ?>

    <?= $form->field($model, 'public')->dropDownList(
        [1 => 'Publikus', 0 => 'Nem publikus',]
    )->label('Státusz:') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
