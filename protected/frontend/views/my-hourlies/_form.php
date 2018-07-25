<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HourliesSales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hourlies-sales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'seller_id')->textInput() ?>

    <?= $form->field($model, 'buyer_id')->textInput() ?>

    <?= $form->field($model, 'item_id')->textInput() ?>

    <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount_bought')->textInput() ?>

    <?= $form->field($model, 'paid')->textInput() ?>

    <?= $form->field($model, 'buyer_cancelled')->textInput() ?>

    <?= $form->field($model, 'seller_cancelled')->textInput() ?>

    <?= $form->field($model, 'completed')->textInput() ?>

    <?= $form->field($model, 'date_completed')->textInput() ?>

    <?= $form->field($model, 'isEscro')->textInput() ?>

    <?= $form->field($model, 'released_escro')->textInput() ?>

    <?= $form->field($model, 'buyer_transaction_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buyer_paypal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seller_paypal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buyer_card_vault')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'complaint')->textInput() ?>

    <?= $form->field($model, 'complaint_message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_refunded')->textInput() ?>

    <?= $form->field($model, 'seller_transaction_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom_trans_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'our_commission')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'totalaftercommission')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sellers_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buyers_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'origional_currency_price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
