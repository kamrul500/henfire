<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JobProposals */

$this->title = Yii::t('app', 'Create Job Proposals');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Proposals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-proposals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('@app/views/templates/forms/_formjobproposal', [
        'model' => $model,
    ]) ?>

</div>
