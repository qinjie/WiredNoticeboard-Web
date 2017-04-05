<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DeviceSetting */

$this->title = 'Create Device Setting';
$this->params['breadcrumbs'][] = ['label' => 'Device Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-setting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
