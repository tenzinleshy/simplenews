<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $modelUpload app\models\uploadForm */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$this->registerJs(
    '$("document").ready(function(){
            $("#new_post").on("pjax:end", function() {
            $("button.close").click();
            $.pjax.reload({container:"#posts"});  //Reload GridView
        });
    });'
);
?>

<div class="post-form">
    <?php Pjax::begin(['id' => 'new_post']); ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true,'enctype' => 'multipart/form-data'],'action' =>['post/create'],'method' => 'post']); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'abridgment')->textarea(['rows' => 6]) ?>
    <?php
        $template = [
        'labelOptions'=>['class'=>'col-lg-3'],
        'template' => '<div class="checkbox">{label}{input}{error}{hint}</div>',
        ];
        echo $form->field($model, 'activity', $template)->checkbox()
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>
