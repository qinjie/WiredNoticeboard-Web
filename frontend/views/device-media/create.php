<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DeviceMedia */

$this->title = 'Create Device Media';
$this->params['breadcrumbs'][] = ['label' => 'Device Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-media-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
