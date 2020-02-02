<?php

use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Bejegyzések', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <b class="text-muted">
        <small>Létrehozva: <b><?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?></b>
            Írta: <a href=/yii2/web/site/profile?id=<?php echo $model->createdBy->id ?> "><b><?php echo $model->createdBy->username ?> </b></a>
            Megtekintések száma: <b><?php echo $model->visitors ?> </b>
        </small>
    </b>
    </p>
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->id === $model->createdBy->id): ?>
    <p>
        <?= Html::a('Szerkesztés', ['update', 'slug' => $model->slug], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Törlés', ['delete', 'slug' => $model->slug], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Biztos törölni akarod??',
                'method' => 'post',
            ],
        ]) ?>
    </p><?php endif; ?>

    <div>

        <?php echo $model->getEncodedBody()   ?>

    <?php if(Yii::$app->user->isGuest || Yii::$app->user->id !== $model->createdBy->id):
        $model = \app\models\Article::find()->where(['id' => $model->id])->one();
        $visitor = $model->visitors + 1;
        $model->visitors = $visitor;
        $model->save();
                 endif; ?>
       <?php
       $model = \app\models\Article::find()->where(['title' => $model->title])->one();
       if($model->commentable !== 0):
       echo \yii2mod\comments\widgets\Comment::widget([
           'model' => $model,
           'dataProviderConfig' => [
               'pagination' => [
                   'pageSize' => 10
               ],
               'sort' => [
                   'defaultOrder' => 'SORT_ASC',
               ]
           ]
       ]);
       endif; ?>
    </div>
</div>
