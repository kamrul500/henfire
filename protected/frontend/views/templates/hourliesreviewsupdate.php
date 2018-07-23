<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HourliesReviews */

$this->title = 'Update Hourlies Reviews: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hourlies Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hourlies-reviews-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('@app/views/templates/forms/hourliesreviews_form', [
        'model' => $model,
    ]) ?>

</div>
