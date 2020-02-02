<?php
use yii\helpers\Html;
use app\models\Article;
/**
 * Created by PhpStorm.
 * User: Kun Flórián
 * Date: 2020. 01. 22.
 * Time: 9:22
 */
/**   */
?>
<?php  if(Yii::$app->user->id === $model->createdBy->id):{?>
    <div>
        <a href="<?php echo \yii\helpers\Url::to(['article/view', 'slug' => $model->slug])?>">

            <h3><?php echo \yii\helpers\Html::encode($model->title) ?></h3>

        </a>
        <b class="text-muted">
            <small>Létrehozva: <b><?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?></b>
                Megtekintések: <b><?php echo $model->visitors; ?> </b>
                Kommentek: <?php
                $mySlug = $model->id;
                $rows = (new \yii\db\Query())
                    ->select(['relatedTo'])
                    ->from('comment')
                    ->where(['like', 'relatedTo', '%' . "$mySlug" , false])
                    ->all();
                echo count($rows);
                ?>
            </small>

        </b>
        <div>
            <?php echo $model->getEncodedDescription(); ?>
            <div><?=
                Html::a('Szerkesztés', ['article/update', 'slug' => $model->slug], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Törlés', ['article/delete', 'slug' => $model->slug], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Biztos törölni akarod??',
                        'method' => 'post',
                    ],
                ]);?></div>
        </div>
        <hr>
    </div>
<?php }endif; ?>
