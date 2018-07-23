<?php
use yii\helpers\Html;
use common\components\MyHelpers;

$numberofitems = $_POST['HourliesSales'];
$hourliedetails = $_POST['Hourlies'];
$basecost = $_POST['basecost'];
$title = $_POST['title'];
$origional_currency_price = $_POST['origional_currency_price'];
$sellers_currency = $_POST['sellers_currency'];
$seller_id = $_POST['seller_id'];
//$total_cost = $hourliedetails['cost'];
$amuont_bought = $numberofitems['amount_bought'];
$antibackfraudprice = $amuont_bought * $basecost;
$length = 12;
$hourlie_id = $hourliedetails['id'];
$OurCommissionset = ($origional_currency_price * $amuont_bought) / 100 * MyHelpers::Commission();
$totalaftercommissionset = ($origional_currency_price * $amuont_bought) - $OurCommissionset;
$OurCommission = round($OurCommissionset, 0, PHP_ROUND_HALF_DOWN);
$totalaftercommission = round($totalaftercommissionset, 0, PHP_ROUND_HALF_DOWN);
$custom_trans_id = '#'.Yii::$app->user->identity->id.$hourliedetails['id'].Yii::$app->security->generateRandomString($length);
$mycurrency = Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency());
$this->title = Yii::t('frontend', 'Buy Hourlie');
?>
<div class="container">
  <div class="col-md-12 web-view">
    <h2><?= Yii::t('frontend', 'Buy Hourlie');;?></h2>
    <hr>
    <div class="col-md-8">
    <div class="col-md-6">
     <?= Html::encode($title); ?>
    </div>
    <div class="col-md-3 text-right">
        <div><?= Yii::t('frontend', 'Unite price:');?></div>
        <hr>
        <div><?= Yii::t('frontend', 'Quantity:');?></div>
        <hr>
        <div><?= Yii::t('frontend', 'Total:');?></div>
    </div>
    <div class="col-md-3 text-right">
        <h4><?= Html::encode($mycurrency.$basecost); ?><h4>
          <hr>
        <div><?= Html::encode($amuont_bought); ?></div>
        <hr>
        <div><?= Html::encode($mycurrency.$antibackfraudprice); ?></div>
    </div>
    </div>
    <div class="col-md-8 text-right">



     <?= $this->render('@app/views/templates/forms/hourliessales_form', [
         'numberofitems' => $numberofitems,
         'hourliedetails' => $hourliedetails,
         'basecost' => $basecost,
         'total_cost' => $antibackfraudprice,
         'amuont_bought' => $amuont_bought,
         'title' => $title,
         'OurCommission' => $OurCommission,
         'totalaftercommission' => $totalaftercommission,
         'seller_id' => $seller_id,
         'hourlie_id' => $hourlie_id,
         'custom_trans_id' => $custom_trans_id,
         'origional_currency_price' => $origional_currency_price,
         'sellers_currency' => $sellers_currency,
         'buyers_currency' => MyHelpers::Currency(),
         'model' => $model,
     ]) ?>
   </div>
     <div class="col-md-4">

     </div>
  </div>
</div>
