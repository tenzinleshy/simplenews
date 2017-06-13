<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\Pjax;
?>

<div class="news-item">
    <h2><?= Html::encode($model->title) ?></h2>
    <div class="meta">
        <p>Автор: <?= Yii::$app->user->getIdentity()->username ?> | Дата публикации: <?= date('D, d M Y', $model->date) ?></p>
    </div>
    <?= HtmlPurifier::process($model->text) ?>
    <!--    --><?php //Pjax::begin(); ?>
    <?php
    echo Html::a('Читать далее', ['/post/list', 'id' => $model->id, 'advanced' => true], ['class' => 'link'])
    ?>
    <!--    --><?//=  Html::a(
    //        'Подробнее',
    //        ['/ost/list/'],
    //        ['class' => 'link']
    //    ) ?>
    <!--    --><?php //Pjax::end(); ?>
    <hr>
    <!--    <div class="image hidden-xs hidden-sm">-->

    <!--    </div>-->
</div>
