<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DeviceSetting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'device_id')->textInput() ?>

    <?= $form->field($model, 'turn_on_time')->textInput() ?>

    <?= $form->field($model, 'turn_off_time')->textInput() ?>

    <?= $form->field($model, 'slide_timing')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
