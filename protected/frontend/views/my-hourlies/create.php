<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HourliesSales */

$this->title = Yii::t('frontend', 'Create Hourlies Sales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Hourlies Sales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hourlies-sales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
