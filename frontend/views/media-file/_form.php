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

    <?= $form->field($model, 'duration')->hiddenInput()->label(false) ?>

    <?php
        if ($model->isNewRecord) {
            echo $form->field($model, 'file')->widget(\kartik\file\FileInput::className(),
                [

                    'options' => [
                        'multiple' => false,
                        'accept' => 'image/*,video/mp4'
                    ],
                    'pluginOptions' => [
//                        'uploadUrl' => Url::to(['/media-file/create']),
                        'uploadAsync' => false,
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
//                        'uploadUrl' => Url::to(['/media-file/create']),
                        'uploadAsync' => false,
                        'showUpload' => false,
                        'initialPreview'=> "../" . $model->file_path,
                        'initialPreviewAsData'=>true,
                        'initialPreviewFileType' => 'image',

                    ]
                ]);
        }
    ?>


<!--    <button onclick="myFunction()">Get duration</button>-->
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'btn-create', 'onclick' => 'myFunction()']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script>
        var x = document.getElementsByClassName("kv-preview-data file-preview-video");
        var duration = document.getElementById("mediafile-duration");
        var d = $('#mediafile-duration');
        $('.file-input').change(function() {
            alert(x[0].duration);
            d.val(x[0].duration);
        });
//        var vid = $('.file-preview-video');
//        var d = ('.mediafile-duration');

        function myFunction() {
//            alert((x[0].duration));
            d.val(x[0].duration);
//            duration.val = x[0].duration;

//            duration.setAttribute('data', x[0].duration);
//            document.getElementById('mediafile-duration').innerHTML = x[0].duration;
//            duration.innerHTML = x[0].duration;
        }
    </script>

</div>