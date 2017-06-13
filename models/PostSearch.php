<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use kartik\daterange\DateRangePicker;
use app\models\Post;

/**
 * PostSearch represents the model behind the search form about `app\models\Post`.
 */
class PostSearch extends Post
{
    public $createTimeRange;
    public $createTimeStart;
    public $createTimeEnd;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'date', 'category_id', 'activity'], 'integer'],
            [['text', 'title', 'abridgment'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param bool $checkRole
     *
     * @return ActiveDataProvider
     */
    public function search($params, $checkRole = false)
    {
        $query = Post::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $filterArr = [
            'id' => $this->id,
            'author_id' => $this->author_id,
            'date' => $this->date,
            'category_id' => $this->category_id,
            'activity' => $this->activity,
        ];
        if($checkRole && Yii::$app->user->can('moderator')){
            $filterArr['author_id'] = Yii::$app->user->getIdentity()->getId();
        }
        $query->andFilterWhere($filterArr);

        $query->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'abridgment', $this->abridgment])
            ->andFilterWhere(['>=', 'date', $this->createTimeStart])
            ->andFilterWhere(['<', 'date', $this->createTimeEnd]);

        return $dataProvider;
    }

    /**
     * Возвращает опубликованные посты
     * @return ActiveDataProvider
     */
    function getPublishedPosts()
    {
        return new ActiveDataProvider([
            'query' => Post::find()
                ->where(['activity' => self::STATUS_ACTIVE])
        ]);
    }
}
