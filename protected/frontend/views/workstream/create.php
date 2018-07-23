<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Workstream */

$this->title = Yii::t('frontend', 'Create Workstream');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Workstreams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workstream-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
