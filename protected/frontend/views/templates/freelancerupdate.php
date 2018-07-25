<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Freelancer */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Freelancer',
]).$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Freelancers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="container">
<div class="freelancer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('forms/freelancer_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
