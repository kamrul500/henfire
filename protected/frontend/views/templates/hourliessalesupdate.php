<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HourliesSales */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Hourlies Sales',
]).$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hourlies Sales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="hourlies-sales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('@app/views/templates/forms/hourliessales_form', [
        'model' => $model,
    ]) ?>

</div>
