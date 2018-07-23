<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jobreviews */

$this->title = Yii::t('frontend', 'Update {modelClass}: ', [
    'modelClass' => 'Jobreviews',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Jobreviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Update');
?>
<div class="jobreviews-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
