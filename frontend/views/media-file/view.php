<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MediaFile */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Media Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-file-view">

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
            'extension',
            'duration',
            'width',
            'height',
            'file_path',
//            'user_id',
            [
                'attribute' => 'user.username',
                'label' => "Username"
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <h3>Preview</h3>
    <div align="center">
        <?php
            $src = "../../../uploads/" . $model->file_path;
            if ($model->isVideo()) {
                echo '<video width="640" height="480" controls>
                    <source src='. $src . '></video>';
            }
            else {
                if ($model->isPdf()){
                    echo '<embed src='.$src.' width="500" height="375" type="application/pdf">';

                }
                else
                    echo '<img src='.$src .'>';
            }
        ?>

    </div>

</div>
