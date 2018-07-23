<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentRequestsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-requests-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'sum') ?>

    <?= $form->field($model, 'job_id') ?>

    <?php // echo $form->field($model, 'hourlie_id') ?>

    <?php // echo $form->field($model, 'withdraw_method') ?>

    <?php // echo $form->field($model, 'paypal_email') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('frontend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
