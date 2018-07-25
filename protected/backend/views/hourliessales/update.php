<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\hourliessales */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Hourliessales',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Hourliessales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="hourliessales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
