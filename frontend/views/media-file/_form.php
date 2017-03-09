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

    <?php
        if ($model->isNewRecord) {
            echo $form->field($model, 'file', ['inputOptions' => ['id' => 'first_name']])->widget(\kartik\file\FileInput::className(),
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
                        'initialPreviewFileType' => 'video',
                        'initialPreviewConfig' => [

                        'filetype' => "video/mp4"

                    ],

                    ]
                ]);
        }
    ?>


    <button onclick="myFunction()">duration</button>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script>

        var vid = document.getElementById("myVideo");
        var vid = $('.file-preview-video');
        var d = ('.mediafile-duration');

        function myFunction() {
            alert(vid.duration);
        }
    </script>

</div>