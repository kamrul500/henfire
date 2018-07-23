<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PaymentRequests */

$this->title = Yii::t('frontend', 'Create Payment Requests');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Payment Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-requests-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
