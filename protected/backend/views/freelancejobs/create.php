<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\freelancejobs */

$this->title = Yii::t('app', 'Create Freelancejobs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Freelancejobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="freelancejobs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
