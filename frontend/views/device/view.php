<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Device */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Devices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'remark',
//            'user_id',
            [
                'attribute' => 'user.username',
                'label' => "Username"
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>
    <h2><?= Html::encode("Current order") ?></h2>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $device,
        'columns' => [
//            'id',
            'sequence',
            [
                'attribute' => 'device_id',
                'value' => 'device.name',
                'label' => 'Device name'

            ],
            [
                'attribute' => 'media_file_id',
                'value' => 'mediaFile.name',
                'label' => "Media file's name"
            ],


            'iteration',

        ],
    ]); ?>
    <p>
        <?= Html::a('Change order', ['show', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>


</div>
