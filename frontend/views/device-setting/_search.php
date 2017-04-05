<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DeviceSettingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-setting-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'device_id') ?>

    <?= $form->field($model, 'turn_on_time') ?>

    <?= $form->field($model, 'turn_off_time') ?>

    <?= $form->field($model, 'slide_timing') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
