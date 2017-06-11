<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<div class="news-item">
    <h2><?= Html::encode($model->title) ?></h2>
    <?= HtmlPurifier::process($model->text) ?>
    <div class="date">
        <?= date('D, d M Y H:i:s', $model->date) ?>
        <hr>
    </div>
<!--    <div class="image hidden-xs hidden-sm">-->
<!--        --><?//= Html::img($model->getImage()->getUrl('200x'), ['class' => 'img-responsive']) ?>
<!--    </div>-->
</div>

