<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jobworkstream */

$this->title = Yii::t('frontend', 'Update {modelClass}: ', [
    'modelClass' => 'Jobworkstream',
]) . $model->job_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Jobworkstreams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->job_id, 'url' => ['view', 'id' => $model->job_id]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Update');
?>
<div class="jobworkstream-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
