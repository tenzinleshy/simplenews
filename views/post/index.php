<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use kartik\daterange\DateRangePicker;


/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $postModel app\models\Post */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
$modelPostSearch = new app\models\PostSearch();
?>

<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        Modal::begin([
            'size' => 'modal-lg',
            'header' => '<h2>Create Post</h2>',
            'id' => 'create',
            'toggleButton'=>[
                'label'=>'Create Post',
                'tag'=>'button',
                'class'=>'btn btn btn-success'
            ],
            'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
            'options'=>['style'=>'min-width:400px']
        ]);

        $modelPopup = new app\models\Post();
        echo $this->context->renderPartial('/post/create', [
            'model' => $modelPopup,
            'postPictureHeight' => $postPictureHeight,
            'postPictureWeight' => $postPictureWeight
        ]);

        Modal::end();
        ?>
    </p>

    <?php Pjax::begin(['id' => 'posts']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'author_id',
//            'date:date',
            [
                'attribute' => 'date',
                'filter' => DateRangePicker::widget([
                    'model'=>$modelPostSearch,
                    'attribute'=>'createTimeRange',
                    'convertFormat'=>true,
                    'pluginOptions'=>[
                        'timePicker'=>true,
                        'timePickerIncrement'=>30,
                        'locale'=>[
                            'format'=>'Y-m-d h:i A'
                        ]
                    ]
                ])
            ],
            'category_id',
            'title',
            'text:ntext',
            'abridgment:ntext',
            [
                'attribute'=>'activity',
//                'value' => function ($model, $key, $index, $column) {
//                    //  var_dump($model); var_dump($key); exit;
//                    return Html::activeDropDownList($model, 'activity',
//                        ArrayHelper::map(\app\models\Post::find()->all(), 'id', 'name'),
//                        [
//                            'prompt' => 'Нет',
//                            'data-id' => $model->id,
//                            'id' => "activity-$model->id",
//                            'onchange' => "
//                                   $.ajax({
//                                     url: \"/post/update\",
//                                     type: \"post\",
//                                     data: { word_id:  $key, group_id : $(\"#activity-$model->id\").val()},
//                                    });"
//                        ]
//
//                    );
//                },
//                'format' => 'raw',
                'filter'=>array("1"=>"Active","0"=>"Disabled"),
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'update' => function ($url,$postModel) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span>',
                            $url);
                    },


                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
