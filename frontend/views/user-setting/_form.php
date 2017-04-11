<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserSetting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'open_enroll')->dropDownList(['0' => 'No', '1' => 'Yes']) ?>

    <div class="row" style="display: flex;">

        <div class="col-md-9">
            <?= $form->field($model, 'enroll_code')->textInput(['maxlength' => true, 'readOnly' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= Html::button("Re-generate code",['class' =>  'btn btn-default', 'onclick' => 'test()', 'style' => 'margin-bottom:15px; position: absolute; bottom: 0;']) ?>
        </div>

    </div>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    function test() {
//        alert("ahihi");
        var tmp = Math.random().toString(36).substring(2,15);
        document.getElementById("usersetting-enroll_code").setAttribute("value", tmp);
    }
</script>
