<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DeviceMediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Device Media';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-media-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Device Media', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',

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

            'sequence',
            'iteration',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
