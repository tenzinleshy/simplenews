<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\Pjax;
?>

<div class="news-item">
    <h2><?= Html::encode($model->title) ?></h2>
    <div class="meta">
        <p>Автор: <?= $model->author_id?> | Дата публикации: <?= date('D, d M Y', $model->date) ?></p>
        <p><?php echo (isset($model->picture))?Html::img($model->picture):"";?></p>
    </div>
    <?= HtmlPurifier::process($model->abridgment) ?>
    <div class="read-more">
    <?php
    if(!Yii::$app->user->isGuest) {
        echo Html::a('Читать далее', ['/post/view', 'id' => $model->id, 'advanced' => true], ['class' => 'link']);
    }else{
        echo Html::a('Авторизуйтесь для просмотра', ['/login'], ['class' => 'link']);
    }
    ?>
    </div>
    <hr>
<!--    <div class="image hidden-xs hidden-sm">-->

<!--    </div>-->
</div>
<!--abridgment-->
