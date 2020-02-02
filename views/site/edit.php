<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;

$this->title = 'Profil szerkesztése';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-edit">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Itt módosíthatod a felhasználói fiókod adatait</p>

    <?php $form = ActiveForm::begin([
        'id' => 'edit-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
    <?php $oldBirthday = Yii::$app->user->identity->birthday; ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true])->textInput()->input('username',  ['value' => Yii::$app->user->identity->username])->label('Felh. név:'); ?>
    <?= $form->field($model, 'email')->textInput()->textInput()->input('email',  ['value' => Yii::$app->user->identity->email])->label('Email:'); ?>
    <?= $form->field($model, 'introduction')->textArea(['value' => Yii::$app->user->identity->introduction]   )->label('Bemutatkozás:'); ?>
    <?= $form->field($model, 'hometown')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\WshCoCity::find()->all(), 'cit_id', 'cit_name'),
        ['value'  => Yii::$app->user->identity->hometown])->label('Lakhely:'); ?>
    <?= $form->field($model, 'birthday')->widget(DatePicker::class, [
        'type' => DatePicker::TYPE_INPUT,
        'value' => Yii::$app->user->identity->birthday,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd',
        ]
    ])->label('Születési dátum:');  ?> <p>Jelenlegi: <?php echo substr(Yii::$app->user->identity->birthday, 0, 10); ?></p>
    <?= $form->field($model, 'password')->passwordInput()->label('Jelszó:') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Szerkesztés', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
