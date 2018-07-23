<?php

use app\models\JobProposals;
//use imanilchaudhari\CurrencyConverter\CurrencyConverter;
use common\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\JobProposals */
/* @var $form yii\widgets\ActiveForm */
$user_id = Yii::$app->user->identity->id;
$mycurrency = MyHelpers::Currency();
$JobProposals = new JobProposals();
$myproposals = JobProposals::find()->where(['user_id' => $user_id, 'job_id' => $model->id])->all();
foreach ($myproposals as $data) {
    $price = $data['price'];
    $comment = $data['comment'];
    $date = $data['date'];
    $accepted = $data['accepted'];
    $delivery_time = $data['delivery_time'];
}
?>

<div class="myproposal col-md-12">
  <div class="myproposaltitle"><?=Yii::t('frontend', 'You have already sent a proposal');?></div>
  <div class="col-md-4">
    <strong><?=Yii::t('frontend', 'Price');?></strong> <?=Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency) . $price;?>
    <br />
    <strong><?=Yii::t('frontend', 'Time');?></strong> <?=$delivery_time;?> <?=Yii::t('frontend', 'days');?>
  </div>
  <div class="col-md-8">
    <?=$comment;?>
  </div>

</div>
