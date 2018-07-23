<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use common\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\JobProposals */
$mycurrency = MyHelpers::Currency();

$OurCommissionset = ($model->price) / 100 * MyHelpers::Commission();
$totalaftercommissionset = ($model->price) - $OurCommissionset;

$OurCommission = round($OurCommissionset, 0, PHP_ROUND_HALF_DOWN);
$totalaftercommission = round($totalaftercommissionset, 0, PHP_ROUND_HALF_DOWN);
?>
<div class="container web-view">


    <h1 class="text-center"><?= Yii::t('frontend','Deposit to Escrow'); ?></h1>
    <h2 class="text-center"><?= Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency);?><?= $model->price;?></h2>
    
    <?php $form = ActiveForm::begin([
	  'options' => ['enctype' => 'multipart/form-data'],
      'action' => ['job-proposals/jobpayment'],
      'method' => 'post',
  ]); ?>
  	<?= $form->field($model2, 'id')->hiddenInput(['value' => $model->job_id])->label(false) ?>
    <?= $form->field($model2, 'freelancr')->hiddenInput(['value' => $model->user_id])->label(false) ?>
    <?= $form->field($model2, 'agreed_price')->hiddenInput(['value' => $model->price])->label(false) ?>
    <?= $form->field($model2, 'our_commission')->hiddenInput(['value' => $OurCommission])->label(false) ?>
    <?= $form->field($model2, 'totalaftercommission')->hiddenInput(['value' => $totalaftercommission])->label(false) ?>
    
   <div class="text-center"> <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'DEPOSIT NOW') : Yii::t('frontend', 'DEPOSIT NOW'), ['class' => $model->isNewRecord ? 'widebutton btn btn-success btn-lg' : 'widebutton btn btn-success btn-lg']) ?></div>
<?php ActiveForm::end(); ?>

</div>
