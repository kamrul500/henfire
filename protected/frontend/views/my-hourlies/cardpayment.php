<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Cardpayment;

/* @var $this yii\web\View */
/* @var $model app\models\HourliesSales */

$this->title = Yii::t('app', 'Card Payment');
$email = Yii::$app->user->identity->email;

?>
<?php $months = ['01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05',
 '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', ]; ?>

 <?php $years = array_combine(range(date('Y', strtotime('+8 years')), date('Y')), range(date('Y', strtotime('+8 years')), date('Y'))); ?>

<div class="container">
  <div class="col-md-12 web-view">
    <div class="col-md-8">
      <h2>Card Payment</h2>
      <?php $form = ActiveForm::begin([
          'action' => ['cardpayment?id='.$model->id],
          'method' => 'post',
      ]); ?>
      <?= $form->field($cardpaymentmodel, 'payment_type')->hiddenInput(['value' => 'cardsubmit'])->label(false); ?>
      <?= $form->field($cardpaymentmodel, 'purchasedetails')->hiddenInput(['value' => $purchaseDetails])->label(false); ?>
      <?= $form->field($cardpaymentmodel, 'email')->hiddenInput(['value' => $email])->label(false); ?>

      <label for="cardNumber">Card Number</label>
       <?= Html::textInput('cardNumber', null, ['class' => 'form-control', 'required' => true]) ?>
       <label for="expMonth">Expire Month</label>
       <?= Html::dropDownList('expMonth', null, $months, ['prompt' => 'Expire Month', 'class' => 'form-control', 'required' => true]) ?>
       <label for="expYear">Expire Year</label>
       <?= Html::dropDownList('expYear', null, $years, ['prompt' => 'Expire Year', 'class' => 'form-control', 'required' => true]) ?>

       <label for="ccV2">CCV2 Number</label>
       <?= Html::textInput('ccV2', null, ['class' => 'form-control', 'required' => true]) ?>

        <label for="cardholder">Card Holders Name</label>
        <?= Html::textInput('cardholder', null, ['class' => 'form-control', 'required' => true]) ?>

      <div class="form-group">
          <?= Html::submitButton(Yii::t('app', 'Make Payment'), ['class' => 'btn btn-success cardloader']) ?>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-4">
      Something extra here
    </div>
  </div>
</div>
<div class="cardloading" style="display:none">Loading&#8230;</div>

<?php
$script = <<< 'JS'
   $(document).ready(function() {
    $( ".cardloader" ).click(function() {
      $(".cardloading").show();

    });
});
JS;
$this->registerJs($script);
?>
