<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DeviceMedia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-media-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'device_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\common\models\Device::find()->all(), 'id', 'name')
    )->label("Device's name")
    ?>

    <?= $form->field($model, 'media_file_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\common\models\MediaFile::find()->all(), 'id', 'name')
    )->label("Media files's name")
    ?>

    <?= $form->field($model, 'sequence')->textInput() ?>

    <?= $form->field($model, 'iteration')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
