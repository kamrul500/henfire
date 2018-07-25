<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HourliesSales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hourlies-sales-form">

  <?php $form = ActiveForm::begin([
      'action' => ['dopayment'],
      'method' => 'post',
  ]); ?>

    <?= $form->field($model, 'seller_id')->hiddenInput(['value' => $seller_id])->label(false) ?>
    <?= $form->field($model, 'buyer_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>
    <?= $form->field($model, 'item_id')->hiddenInput(['value' => $hourlie_id])->label(false) ?>
    <?= $form->field($model, 'item_name')->hiddenInput(['value' => $title, 'maxlength' => true])->label(false) ?>
    <?= $form->field($model, 'cost')->hiddenInput(['value' => $basecost])->label(false) ?>
    <?= $form->field($model, 'total_cost')->hiddenInput(['value' => $total_cost])->label(false) ?>
    <?= $form->field($model, 'amount_bought')->hiddenInput(['value' => $amuont_bought])->label(false) ?>
    <?= $form->field($model, 'our_commission')->hiddenInput(['value' => $OurCommission])->label(false) ?>
    <?= $form->field($model, 'totalaftercommission')->hiddenInput(['value' => $totalaftercommission])->label(false) ?>
    <?= $form->field($model, 'custom_trans_id')->hiddenInput(['value' => $custom_trans_id])->label(false) ?>
    <?= $form->field($model, 'origional_currency_price')->hiddenInput(['value' => $origional_currency_price])->label(false) ?>
    <?= $form->field($model, 'sellers_currency')->hiddenInput(['value' => $sellers_currency])->label(false) ?>
    <?= $form->field($model, 'buyers_currency')->hiddenInput(['value' => $buyers_currency])->label(false) ?>
    <div class="col-md-12">
     <div class="col-md-4">
       <?php $model->payment_type = "radio2"; ?>
    <?= $form->field($model, 'payment_type', ['template' => "<div class=\"radio2\">\n{input}\n<label class=\"control-label\" for=\"radio2\"><div class=\"divasradio2 radiochecked\"><div class=\"radiotitle2 text-center\">".Yii::t('frontend','PayPal Payment')."</div><div class=\"radiotext text-center\">".Yii::t('frontend','For standard payment express')."</div></div></label>\n{error}\n{hint}\n</div>"])->input('radio', ['value' => 'PayPal', 'id' => 'radio2', 'uncheck' => null])?>
    </div>
    <div class="col-md-4" style="display:none">
    <?= $form->field($model, 'payment_type', ['template' => "<div class=\"radio3\">\n{input}\n<label class=\"control-label\" for=\"radio3\"><div class=\"divasradio3\"><div class=\"radiotitle3 text-center\">".Yii::t('frontend','Card Payment')."</div><div class=\"radiotext text-center\">".Yii::t('frontend','Direct Card Payment')."</div></div></label>\n{error}\n{hint}\n</div>"])->input('radio', ['value' => 'CardPayment', 'id' => 'radio3', 'uncheck' => null])?>
    </div>
    </div>
    <div class="form-group">
      <div class="col-md-6 text-left">
        <small class="pull-left"><?= Yii::t('frontend', 'Your deposit will be held in an Escrow untill you are happy to release it to the seller upon completion.');?></small>
      </div>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'BUY HOURLIE') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< 'JS'
   $(document).ready(function() {
     $("#radio2").prop("checked", true);

    $( ".radio1" ).click(function() {
      $(".divasradio1").addClass('radiochecked');
      $(".divasradio2").removeClass('radiochecked');
      $(".divasradio3").removeClass('radiochecked');
    });
    $( ".radio2" ).click(function() {
      $(".divasradio1").removeClass('radiochecked');
      $(".divasradio2").addClass('radiochecked');
      $(".divasradio3").removeClass('radiochecked');
    });
    $( ".radio3" ).click(function() {
      $(".divasradio1").removeClass('radiochecked');
      $(".divasradio2").removeClass('radiochecked');
      $(".divasradio3").addClass('radiochecked');
    });
});
JS;
$this->registerJs($script);
?>
