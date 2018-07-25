<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentRequests */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Payment Requests',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Payment Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="payment-requests-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
