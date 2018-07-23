<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HourliessalesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hourliessales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'seller_id') ?>

    <?= $form->field($model, 'buyer_id') ?>

    <?= $form->field($model, 'item_id') ?>

    <?= $form->field($model, 'item_name') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'total_cost') ?>

    <?php // echo $form->field($model, 'amount_bought') ?>

    <?php // echo $form->field($model, 'paid_status') ?>

    <?php // echo $form->field($model, 'buyer_cancelled') ?>

    <?php // echo $form->field($model, 'seller_cancelled') ?>

    <?php // echo $form->field($model, 'completed') ?>

    <?php // echo $form->field($model, 'date_completed') ?>

    <?php // echo $form->field($model, 'isEscro') ?>

    <?php // echo $form->field($model, 'released_escro') ?>

    <?php // echo $form->field($model, 'buyer_transaction_code') ?>

    <?php // echo $form->field($model, 'payment_type') ?>

    <?php // echo $form->field($model, 'buyer_paypal') ?>

    <?php // echo $form->field($model, 'buyer_paypal_auth') ?>

    <?php // echo $form->field($model, 'seller_paypal') ?>

    <?php // echo $form->field($model, 'buyer_card_vault') ?>

    <?php // echo $form->field($model, 'complaint') ?>

    <?php // echo $form->field($model, 'complaint_message') ?>

    <?php // echo $form->field($model, 'is_refunded') ?>

    <?php // echo $form->field($model, 'seller_transaction_code') ?>

    <?php // echo $form->field($model, 'custom_trans_id') ?>

    <?php // echo $form->field($model, 'our_commission') ?>

    <?php // echo $form->field($model, 'totalaftercommission') ?>

    <?php // echo $form->field($model, 'sellers_currency') ?>

    <?php // echo $form->field($model, 'buyers_currency') ?>

    <?php // echo $form->field($model, 'origional_currency_price') ?>

    <?php // echo $form->field($model, 'freelancer_paid') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
