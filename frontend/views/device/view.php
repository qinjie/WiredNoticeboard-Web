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
//            'id',
            'name',
            'remark',
            'token',
//            'user_id',
            [
                'attribute' => 'user.username',
                'label' => "Username"
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>
    <h2><?= Html::encode("Play order") ?></h2>
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
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'template' => '{update}  {delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        $url = \yii\helpers\Url::to(['device-media/delete', 'id' => $model->id]);
//                        return Html::a('<span class="fa fa-eye"></span>', $url, ['title' => 'view']);
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                            'data-method' => 'post',
                        ]);
                    },
                    'update' => function ($url, $model) {
                        $url = \yii\helpers\Url::to(['device-media/update', 'id' => $model->id]);
//                        return Html::a('<span class="fa fa-eye"></span>', $url, ['title' => 'view']);
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                            'data-method' => 'post',
                        ]);
                    },
                ]
            ],

        ],
    ]); ?>
    <p>
        <?= Html::a('Change order', ['show', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Add media file', ['add', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>


</div>
