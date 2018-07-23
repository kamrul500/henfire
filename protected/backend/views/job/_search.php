<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JobSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'subCat') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'date_expire') ?>

    <?php // echo $form->field($model, 'material') ?>

    <?php // echo $form->field($model, 'promoted') ?>

    <?php // echo $form->field($model, 'paid') ?>

    <?php // echo $form->field($model, 'success') ?>

    <?php // echo $form->field($model, 'isEscro') ?>

    <?php // echo $form->field($model, 'released_escro') ?>

    <?php // echo $form->field($model, 'freelancer') ?>

    <?php // echo $form->field($model, 'freelancer_paypal') ?>

    <?php // echo $form->field($model, 'buyer_cancelled') ?>

    <?php // echo $form->field($model, 'seller_cancelled') ?>

    <?php // echo $form->field($model, 'date_completed') ?>

    <?php // echo $form->field($model, 'worktype') ?>

    <?php // echo $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'budget') ?>

    <?php // echo $form->field($model, 'agreed_price') ?>

    <?php // echo $form->field($model, 'experience_level') ?>

    <?php // echo $form->field($model, 'buyer_transaction_code') ?>

    <?php // echo $form->field($model, 'payment_type') ?>

    <?php // echo $form->field($model, 'buyer_paypal') ?>

    <?php // echo $form->field($model, 'buyer_paypal_auth') ?>

    <?php // echo $form->field($model, 'seller_paypal') ?>

    <?php // echo $form->field($model, 'buyer_card_vault') ?>

    <?php // echo $form->field($model, 'complaint') ?>

    <?php // echo $form->field($model, 'complaint_message') ?>

    <?php // echo $form->field($model, 'custom_trans_id') ?>

    <?php // echo $form->field($model, 'our_commission') ?>

    <?php // echo $form->field($model, 'totalaftercommission') ?>

    <?php // echo $form->field($model, 'sellers_currency') ?>

    <?php // echo $form->field($model, 'buyers_currency') ?>

    <?php // echo $form->field($model, 'origional_currency_price') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
