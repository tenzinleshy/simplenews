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

<!--    --><?//= $form->field($model, 'author_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), [
//        'dateFormat' => 'php:U',
//        'options' => ['class'=>'form-control']
////        'inline' => true
//    ]) ?>

<!--    --><?//= $form->field($model, 'category_id')->textInput() ?>
<!--    --><?//=$form->field($model, 'picture')->fileInput();?>
<!--    --><?//= $form->field($model, 'imageFile')->fileInput() ?>

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

<!--    --><?//= $form->field($model, 'activity', ['options' => ['style' => 'margin:35px 0px 40px 0px;']])->checkbox([
//        'value'=>0,
//        'uncheck'=>1,
//        'checked '=>$model->activity?false:true,
//        'class'=>'cmn-toggle cmn-toggle-round-small',
//        'label'=>false,
//    ], false)?>

<!--    --><?//= $form->field($model, 'activity')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>
