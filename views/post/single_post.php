<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\ActiveField;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $postModel app\models\Post */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = $model->title;
$modelPostSearch = new app\models\PostSearch();
?>

<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="news-item">
        <h2><?= Html::encode($model->title) ?></h2>
        <div class="meta">
            <p>Автор: <?= $model->author_id?> | Дата публикации: <?= date('D, d M Y', $model->date) ?></p>
        </div>
        <?= $model->text ?>

        <hr>
        <!--    <div class="image hidden-xs hidden-sm">-->

        <!--    </div>-->
    </div>

</div>
