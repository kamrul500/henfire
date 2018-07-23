<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Freelancer */

$this->title = Yii::t('app', 'Create Freelancer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Freelancers'), 'url' => ['freelancer']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
<div class="freelancer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('forms/freelancer_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
