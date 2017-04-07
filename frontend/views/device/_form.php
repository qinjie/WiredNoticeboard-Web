<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Device */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mac')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'turn_on_time')->widget(\kartik\time\TimePicker::classname(),
    [
        'name' => 't2',
        'pluginOptions' => [
//        'showSeconds' => true,
        'showMeridian' => false,
        'minuteStep' => 30,
        'secondStep' => 0,
    ]]
    ) ?>
    <?= $form->field($model, 'turn_off_time')->widget(\kartik\time\TimePicker::classname(),
        [
            'name' => 't2',
            'pluginOptions' => [
//        'showSeconds' => true,
                'showMeridian' => false,
                'minuteStep' => 30,
                'secondStep' => 0,
            ]]
    ) ?>

    <?= $form->field($model, 'slide_timing')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
