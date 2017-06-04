<?php

use yii\helpers\Html;
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
        <?//= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
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
