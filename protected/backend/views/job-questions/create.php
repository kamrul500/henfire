<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JobQuestions */

$this->title = Yii::t('backend', 'Create Job Questions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Job Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-questions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
