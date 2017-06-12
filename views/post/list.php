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
$modelPostSearch = new app\models\PostSearch();
?>

<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php
Pjax::begin();

echo ListView::widget([
    'dataProvider' => $listDataProvider,
    'itemView' => '_list',
//    'itemView' => $advanced ? '_list' : '_list-advanced',
    'options' => [
        'tag' => 'div',
        'class' => 'news-list',
        'id' => 'news-list',
    ],
    'layout' => "{summary}\n{items}\n{pager}",

    'summary' => 'Показано {count} из {totalCount}',
    'summaryOptions' => [
    'tag' => 'span',
    'class' => 'my-summary',
    'itemOptions' => [
        'tag' => 'div',
        'class' => 'news-item',
    ],
    'emptyText' => 'Список новостей пуст',
    'emptyTextOptions' => [
        'tag' => 'p'
    ],
    'pager' => [
        'firstPageLabel' => 'Первая',
        'lastPageLabel' => 'Последняя',
        'nextPageLabel' => 'Следующая',
        'prevPageLabel' => 'Предыдущая',
        'maxButtonCount' => 5,
    ],
],
]);


echo Html::beginForm(['post/list'], 'post', ['data-pjax' => '', 'class' => 'form-inline', 'id'=>'per-page']);
echo Html::dropDownList('per-page-select', $selected, $numItems,['onchange'=>'$(\'#per-page\').submit();']);
echo Html::endForm();
Pjax::end();

//$form = ActiveForm::begin();
//    $items = [
//        '0' => 'Активный',
//        '1' => 'Отключен',
//        '2'=>  'Удален'
//    ];
//    $params = [
//        'prompt' => 'Выберите статус...'
//    ];
////var_dump($numItems);die;
//    echo $form->field($postModel, 'activity')->dropDownList($items,$params);
//ActiveForm::end();
?>

</div>
