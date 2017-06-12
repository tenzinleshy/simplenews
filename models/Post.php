<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property integer $author_id
 * @property integer $date
 * @property integer $category_id
 * @property string $text
 * @property string $title
 * @property string $abridgment
 * @property integer $activity
 */
class Post extends \yii\db\ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 0;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'date', 'category_id', 'text', 'title', 'abridgment'], 'required'],
            [['author_id', 'date', 'category_id', 'activity'], 'integer'],
            [['text', 'abridgment'], 'string'],
            [['title', 'picture'], 'string', 'max' => 255],
            [['title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'date' => 'Date',
            'category_id' => 'Category ID',
            'text' => 'Text',
            'title' => 'Title',
            'abridgment' => 'Abridgment',
            'activity' => 'Published',
            'picture' => 'Picture'
        ];
    }

    /**
     * Возвращает опубликованные посты
     * @return ActiveDataProvider
     */
    function getPublishedPosts()
    {
        return new ActiveDataProvider([
            'query' => Post::find()
                ->where(['activity' => 1])
        ]);
    }

    /**
     * Возвращает опубликованные посты
     * @param integer $id
//     * @return ActiveDataProvider
     */
    function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

}
