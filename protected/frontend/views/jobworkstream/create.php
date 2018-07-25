<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Jobworkstream */

$this->title = Yii::t('frontend', 'Create Jobworkstream');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Jobworkstreams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobworkstream-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
