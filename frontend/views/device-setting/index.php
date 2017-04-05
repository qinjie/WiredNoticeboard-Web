<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DeviceSettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Device Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-setting-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Device Setting', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'device_id',
            'turn_on_time',
            'turn_off_time',
            'slide_timing',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
