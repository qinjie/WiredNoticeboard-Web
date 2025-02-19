<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MediaFileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Media Files';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-file-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Upload Media File', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            'extension',
            'duration',
//            'width',
            // 'height',
            // 'file_path',

            [
                'attribute' => 'user_id',
                'label' => 'Username',
                'value' => 'user.username',
            ],
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
