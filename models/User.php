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
class User extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username', 'email'], 'required'],
            [['id', 'create_at', 'update_at'], 'integer'],
            [['username', 'auth_key','password_hash','email','photo'], 'string'],
            [['username', 'photo'], 'string', 'max' => 255],
            [['username'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'User Name',
            'email' => 'Email',
            'create_at' => 'Create At'
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

//    /**
//     * Возвращает опубликованные посты
//     * @param integer $id
////     * @return ActiveDataProvider
//     */
//    function getAuthor()
//    {
//        return $this->hasOne(User::className(), ['id' => 'author_id']);
//    }

}
