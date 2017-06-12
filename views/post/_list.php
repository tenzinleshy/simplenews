<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\Pjax;
?>

<div class="news-item">
    <h2><?= Html::encode($model->title) ?></h2>
    <div class="meta">
        <p>Автор: <?= $model->author_id?> | Дата публикации: <?= date('D, d M Y', $model->date) ?></p>
    </div>
    <?= HtmlPurifier::process($model->abridgment) ?>
    <?php echo Html::a('Читать далее', ['/post/view', 'id' => $model->id, 'advanced' => true], ['class' => 'link']);?>
    <hr>
<!--    <div class="image hidden-xs hidden-sm">-->
<!--        --><?//= Html::img($model->getImage()->getUrl('200x'), ['class' => 'img-responsive']) ?>
<!--    </div>-->
</div>
<!--abridgment-->
<!--<div class="content">-->
<!--    --><?//= $model->anons ?>
<!--</div>-->