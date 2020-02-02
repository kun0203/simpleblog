<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RegistrationForm */

use yii\helpers\Html;

$this->title = 'Profil';
$usedId = $_REQUEST;
$user = \app\models\User::findOne($usedId);

?>
<div class="site-edit">
    <h1><?= Html::encode($this->title) ?></h1>
<?php $cityArray = \yii\helpers\ArrayHelper::map(\app\models\WshCoCity::find()->all(), 'cit_id', 'cit_name');
 ?>
        <h3>Felhasználónév: <?= $user->username; ?></h3>
        <br>
    <h3>Email: <?= $user->email; ?></h3>
        <br>
        <?php if($user->birthday){ ?>
        <h3>Születési idő: <?= substr(($user->birthday), 0, 10); ?></h3>
        <br>    <?php } ?>
        <?php if($user->introduction){ ?>
        <h3>Bemutatkozó szöveg: <?= $user->introduction; ?></h3>
        <br>    <?php } ?>
        <?php if($user->hometown){ ?>
                <h3>Lakhely: <?= $cityArray[$user->hometown]; ?></h3>
        <br>    <?php } ?>
                    <h3>Bejegyzések száma: <a href="/yii2/web?id=<?php echo $user->id; ?>"> <?= $count = \app\models\Article::find()->where(['created_by' => $user->id])->count(); ?> </a>
        <br>
</div>
