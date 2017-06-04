<?php

namespace app\models;

use Yii;

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
            'activity' => 'Activity',
            'picture' => 'Picture'
        ];
    }


}
