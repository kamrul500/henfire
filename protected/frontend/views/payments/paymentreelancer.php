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
                <div><?=Yii::t('frontend', 'Available funds');?></div>
                </div>
                <div class="col-md-3">
                  <div><strong><?= $sitecurrency;?><?= $availablefunds; ?></strong></div>
                </div>
      </div>
      <div class="col-md-9">
        <div class="profile_heading">
            <h2><strong><span class="fa fa-fw"></span><?=Yii::t('frontend', 'Payment Dashboard');?></strong></h2>
        </div>
      <?php $form = ActiveForm::begin(); ?>

         <div class="col-md-4">
           <?= $form->field($model, 'payment_type', ['template' => "<div class=\"radio1\">\n{input}\n<label class=\"control-label\" for=\"radio1\"><div class=\"divasradio1 radiochecked\"><div class=\"radiotitle1 text-center\">".Yii::t('frontend', 'My Account')."</div><div class=\"radiotext text-center\">".Yii::t('frontend', 'My available funds')."<br /><h3>$sitecurrency $availablefunds</h3></div></div></label>\n{error}\n{hint}\n</div>"])->input('radio', ['value' => 'PayPal', 'id' => 'radio1', 'uncheck' => null])?>
         </div>
         <div class="col-md-4">
           <?= $form->field($model, 'payment_type', ['template' => "<div class=\"radio2\">\n{input}\n<label class=\"control-label\" for=\"radio2\"><div class=\"divasradio2\"><div class=\"radiotitle2 text-center\">".Yii::t('frontend', 'My Buyer Escrow')."</div><div class=\"radiotext text-center\">".Yii::t('frontend', 'Funds ready to be sent')."<br /><h3>$sitecurrency $buyerescrow</h3></div></div></label>\n{error}\n{hint}\n</div>"])->input('radio', ['value' => 'CardPayment', 'id' => 'radio2', 'uncheck' => null])?>
         </div>
         <div class="col-md-4">
           <?= $form->field($model, 'payment_type', ['template' => "<div class=\"radio3\">\n{input}\n<label class=\"control-label\" for=\"radio3\"><div class=\"divasradio3\"><div class=\"radiotitle3 text-center\">".Yii::t('frontend', 'My Seller Escrow')."</div><div class=\"radiotext text-center\">".Yii::t('frontend', 'In Escrow')."<br /> <h3>$sitecurrency $sellerescrow</h3></div></div></label>\n{error}\n{hint}\n</div>"])->input('radio', ['value' => 'CardPayment', 'id' => 'radio3', 'uncheck' => null])?>
         </div>

         <div class="clearfix"></div>
        <?php ActiveForm::end(); ?>

        <div class="depositcash1">
          <table id="example" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th><?=Yii::t('backend', 'Job');?></th>
              <th><?=Yii::t('backend', 'Type');?></th>
              <th><?=Yii::t('backend', 'Price');?></th>
              <th><?=Yii::t('backend', 'Withdraw');?></th>

            </tr>
            </thead>
            <tbody>
              <?php $form = ActiveForm::begin(['action' => ['PaymentRequests/request?id='.$model->job_id],'options' => ['method' => 'post', 'enctype' => 'multipart/form-data']]);?>
              <?=$PaymentsTable;?>
              <?php ActiveForm::end();?>
            </tbody>
          </table>

        </div>
        <div class="depositcash2" style="display:none">

          <table id="fff" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th><?=Yii::t('backend', 'Job');?></th>
              <th><?=Yii::t('backend', 'Price');?></th>
              <th><?=Yii::t('backend', 'Status');?></th>

            </tr>
            </thead>
            <tbody>
              <?=$MyBuyertable;?>
            </tbody>
          </table>
          <strong><?= Yii::t('frontend', 'Total Escrow amount');?> <?= $sitecurrency;?><?= $buyerescrow;?></strong>
        </div>
        <?php if(Yii::$app->user->identity->is_freelancer == 1)
        {?>
        <div class="depositcash3" style="display:none">

          <table id="withdraw" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th><?=Yii::t('backend', 'Name');?></th>
              <th><?=Yii::t('backend', 'Price');?></th>
              <th><?=Yii::t('backend', 'Status');?></th>
            </tr>
            </thead>
            <tbody>
              <?=$MySellertable;?>
            </tbody>
          </table>
          <strong><?= Yii::t('frontend', 'Total Buyer Escrow');?> <?= $sitecurrency;?><?= $sellerescrow; ?></strong>
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
