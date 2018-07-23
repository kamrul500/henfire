<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Pyments';
$sitecurrency = Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($currency) ?>
<div class="container">
    <div class="col-md-12 web-view">
      <div class="col-md-3 pull-right">
        <div class="profile_heading">
            <h5><strong><span class="fa fa-fw fa-circle-o"></span><?=Yii::t('frontend', 'funds overview')?></strong></h5>
        </div>
            <div class="col-md-9">

              <div><?=Yii::t('frontend', 'Paid to Date');?></div>
              <div><?=Yii::t('frontend', 'Available funds');?></div>
            </div>
            <div class="col-md-3">
              <div><strong>0.001</strong></div>
              <div><strong><?= $sitecurrency;?><?= $availablefunds; ?></strong></div>
            </div>

      </div>
      <div class="col-md-9">
        <div class="profile_heading">
            <h2><strong><span class="fa fa-fw"></span><?=Yii::t('frontend', 'Payment Dashboard');?></strong></h2>
        </div>
      <?php $form = ActiveForm::begin(); ?>

         <div class="col-md-4">
           <?= $form->field($model, 'payment_type', ['template' => "<div class=\"radio1\">\n{input}\n<label class=\"control-label\" for=\"radio1\"><div class=\"divasradio1 radiochecked\"><div class=\"radiotitle1 text-center\">".Yii::t('frontend', 'My Payments')."</div><div class=\"radiotext text-center\">".Yii::t('frontend', 'Funds paid')."<br /><h3>$sitecurrency $availablefunds</h3></div></div></label>\n{error}\n{hint}\n</div>"])->input('radio', ['value' => 'PayPal', 'id' => 'radio1', 'uncheck' => null])?>
         </div>
         <div class="col-md-4">
           <?= $form->field($model, 'payment_type', ['template' => "<div class=\"radio2\">\n{input}\n<label class=\"control-label\" for=\"radio2\"><div class=\"divasradio2\"><div class=\"radiotitle2 text-center\">".Yii::t('frontend', 'My Buyer Escrow')."</div><div class=\"radiotext text-center\">".Yii::t('frontend', 'Funds ready to be sent')."<br /><h3>$sitecurrency $buyerescrow</h3></div></div></label>\n{error}\n{hint}\n</div>"])->input('radio', ['value' => 'CardPayment', 'id' => 'radio2', 'uncheck' => null])?>
         </div>


         <div class="clearfix"></div>
        <?php ActiveForm::end(); ?>

        <div class="depositcash1">
          <?= Yii::t('frontend', 'All Payments');?> <?= $sitecurrency;?><?= $availablefunds;?>

        </div>
        <div class="depositcash2" style="display:none">
          <?= Yii::t('frontend', 'Buyer Escrowq amount');?> <?= $sitecurrency;?><?= $buyerescrow;?>
        </div>
        <?php if(Yii::$app->user->identity->is_freelancer == 1)
        {?>
        <div class="depositcash3" style="display:none">
          <?= Yii::t('frontend', 'Seller scrow amount');?> <?= $sitecurrency;?><?= $sellerescrow; ?>
        </div>
        <?php }?>
      </div>
    </div>
</div>
<?php
$script = <<< 'JS'
   $(document).ready(function() {
    $( ".radio1" ).click(function() {
      $(".divasradio1").addClass('radiochecked');
      $(".divasradio2").removeClass('radiochecked');
      $(".divasradio3").removeClass('radiochecked');
      $(".depositcash1").show();
      $(".depositcash2").hide();
      $(".depositcash3").hide();
    });
    $( ".radio2" ).click(function() {
      $(".divasradio1").removeClass('radiochecked');
      $(".divasradio2").addClass('radiochecked');
      $(".divasradio3").removeClass('radiochecked');
      $(".depositcash1").hide();
      $(".depositcash2").show();
      $(".depositcash3").hide();
    });
    $( ".radio3" ).click(function() {
      $(".divasradio1").removeClass('radiochecked');
      $(".divasradio2").removeClass('radiochecked');
      $(".divasradio3").addClass('radiochecked');
      $(".depositcash1").hide();
      $(".depositcash2").hide();
      $(".depositcash3").show();
    });
});
JS;
$this->registerJs($script);
?>
