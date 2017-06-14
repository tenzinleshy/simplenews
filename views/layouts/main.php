<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Simple News',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $items = [
        ['label' => 'Home', 'url' => ['/']],
//        ['label' => 'About', 'url' => ['/site/about']],
//            ['label' => 'Contact', 'url' => ['/site/contact']],
//        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];

    if(!Yii::$app->user->isGuest){
        if(Yii::$app->user->can('administrator')||Yii::$app->user->can('moderator')){
            $items[] = ['label' => 'Manage News', 'url' => ['/post/index']];
            if(Yii::$app->user->can('administrator')){
                $items[] = ['label' => 'RBAC', 'url' => ['/user/rbac']];
                $items[] = ['label' => 'Manage Users', 'url' => ['/user/admin']];
            }
        }
        $items[] = ['label' => 'Profile', 'url' => ['/profile']];
    }else{
        $items[] = ['label' => 'Signup', 'url' => ['/signup']];
    }
    $items[] = (Yii::$app->user->isGuest) ? (
        ['label' => 'Login', 'url' => ['/login']]
    ) : (
        '<li>'
        . Html::beginForm(['/logout'], 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>'
    );
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
