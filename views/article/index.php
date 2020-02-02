<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bejegyzések';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(!Yii::$app->user->isGuest): ?>
    <p>
        <?= Html::a('Bejegyzés létrehozás', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Saját bejegyzések', ['/site/own'], ['class'=>'btn btn-primary']) ?>

    </p>
    <?php endif; ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= \yii\widgets\ListView::widget([
        'layout' => "{sorter}\n{items}\n{pager}",
        'sorter' => ['id' => 'id'],
        'dataProvider' => $dataProvider,
        'itemView' => '_article_item'

    ]); ?>




</div>
