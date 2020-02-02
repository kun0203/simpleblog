<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property string description
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $commentable
 * @property int|null $public
 * @property int|null $visitors
 *
 * * @property int|null $comments
 *
 * @property User $createdBy
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    public function behaviors(){
        return [
            TimestampBehavior::class,
           [ 'class'=>BlameableBehavior::class,
            'updatedByAttribute' => false
        ],
        [
            'class'=>SluggableBehavior::class,
            'attribute' => 'title'
        ]
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['title', 'unique', 'message'=>'A cím már használatban van'],
            [['title', 'slug', 'body', 'description'], 'required'],
            [['description'], 'string', 'max' => 255],
            [['body', 'description'], 'string'],
            [['created_at', 'updated_at', 'created_by', 'commentable', 'public', 'visitors', 'comments'], 'integer'],
            [['title'], 'string', 'max' => 60],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'description' => 'Description',
            'body' => 'Body',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'commentable' => 'Commentable',
            'public' => 'Public',
            'visitors' => 'Visitors',
            'comments' => 'Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getEncodedBody(){
        return Html::encode($this->body);
    }

    public function getEncodedDescription(){
        return Html::encode($this->description);
    }
}
