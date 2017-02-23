<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MediaFile */

$this->title = 'Create Media File';
$this->params['breadcrumbs'][] = ['label' => 'Media Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-file-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
