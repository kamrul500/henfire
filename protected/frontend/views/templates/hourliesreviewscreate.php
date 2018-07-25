<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HourliesReviews */

$this->title = 'Create Hourlies Reviews';
$this->params['breadcrumbs'][] = ['label' => 'Hourlies Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hourlies-reviews-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('@app/views/templates/forms/hourliesreviews_form', [
        'model' => $model,
    ]) ?>

</div>
