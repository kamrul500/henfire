<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Hourlieworkstream */

$this->title = Yii::t('frontend', 'Update {modelClass}: ', [
    'modelClass' => 'Hourlieworkstream',
]) . $model->job_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Hourlieworkstreams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->job_id, 'url' => ['view', 'id' => $model->job_id]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Update');
?>
<div class="hourlieworkstream-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
