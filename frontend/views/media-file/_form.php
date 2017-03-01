<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\MediaFile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="media-file-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'duration')->textInput() ?>

    <?= $form->field($model, 'width')->textInput() ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?php
        if ($model->isNewRecord) {
            echo $form->field($model, 'file')->widget(\kartik\file\FileInput::className(),
                [

                    'options' => [
                        'multiple' => false,
                        'accept' => 'image/*,video/mp4'
                    ],
                    'pluginOptions' => [
                        'uploadUrl' => Url::to(['/site/create']),
                        'showUpload' => false,
                    ]
                ]);
        }
        else {
            echo $form->field($model, 'file')->widget(\kartik\file\FileInput::className(),
                [

                    'options' => [
                        'multiple' => false,
                        'accept' => 'image/*,video/mp4'
                    ],
                    'pluginOptions' => [
                        'uploadUrl' => Url::to(['/site/create']),
                        'showUpload' => false,
                        'initialPreview'=> "../" . $model->file_path,
                        'initialPreviewAsData'=>true,
                    ]
                ]);
        }
    ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>