<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JobProposals */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Job Proposals',
]).$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Proposals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="job-proposals-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('@app/views/templates/forms/_formjobproposal', [
        'model' => $model,
    ]) ?>

</div>
