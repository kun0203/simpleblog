<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Saját bejegyzéseid';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(!Yii::$app->user->isGuest): ?>

    <?php endif; ?>

    <?= \yii\widgets\ListView::widget([
        'layout' => "{items}{pager}",
        'sorter' => ['id' => 'id'],
        'dataProvider' => $dataProvider,
        'itemView' => '_own_item'

    ]); ?>




</div>
