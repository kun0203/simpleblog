<?php
/**
 * Created by PhpStorm.
 * User: Kun Flórián
 * Date: 2020. 01. 22.
 * Time: 9:22
 */
/**   */
use yii\helpers\Html;
?>
<?php
if(!isset($_GET['id']) || $_GET['id'] == $model->created_by){
if($model->public !== 0):{?>
<div>
   <a href="<?php echo \yii\helpers\Url::to(['article/view', 'slug' => $model->slug])?>">

       <h3><?php echo \yii\helpers\Html::encode($model->title) ?></h3>

   </a>
    <b class="text-muted">
        <small>Létrehozva: <b><?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?></b>
            Írta: <a href=site/profile?id=<?php echo $model->createdBy->id ?> "><b><?php echo $model->createdBy->username ?> </b></a>
            Megtekintések: <b><?php echo $model->visitors; ?> </b>
            Kommentek: <?php
            $mySlug = $model->id;
            $rows = (new \yii\db\Query())
                ->select(['relatedTo'])
                ->from('comment')
                ->where(['like', 'relatedTo', '%' . "$mySlug" , false])
                ->all();
            $model->comments = count($rows);
            $model->save();
            echo Html::encode($model->comments);
            ?>
        </small>
    </b>
    <div>
        <?php echo $model->getEncodedDescription(); ?>
    </div>
    <hr>
</div>
<?php }endif;}?>
