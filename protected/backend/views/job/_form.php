<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Job */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subCat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_created')->textInput() ?>

    <?= $form->field($model, 'date_expire')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'material')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'promoted')->textInput() ?>

    <?= $form->field($model, 'paid')->textInput() ?>

    <?= $form->field($model, 'success')->textInput() ?>

    <?= $form->field($model, 'isEscro')->textInput() ?>

    <?= $form->field($model, 'released_escro')->textInput() ?>

    <?= $form->field($model, 'freelancer')->textInput() ?>

    <?= $form->field($model, 'freelancer_paypal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buyer_cancelled')->textInput() ?>

    <?= $form->field($model, 'seller_cancelled')->textInput() ?>

    <?= $form->field($model, 'date_completed')->textInput() ?>

    <?= $form->field($model, 'worktype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'budget')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agreed_price')->textInput() ?>

    <?= $form->field($model, 'experience_level')->textInput() ?>

    <?= $form->field($model, 'buyer_transaction_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buyer_paypal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buyer_paypal_auth')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seller_paypal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buyer_card_vault')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'complaint')->textInput() ?>

    <?= $form->field($model, 'complaint_message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'custom_trans_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'our_commission')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'totalaftercommission')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sellers_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buyers_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'origional_currency_price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
