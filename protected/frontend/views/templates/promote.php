<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\models\Hourlies;
use yii\helpers\ArrayHelper;
use common\components\MyHelpers;
$this->title = Yii::t('frontend', 'Feature your hourlie');
$model->promoted = '1';;
?>
<div class="container">
	<div class="col-md-12 web-view update_profile">
    <div class="col-md-8">
      <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action' => 'promote', 'method' => 'post', 'layout' => 'horizontal']); ?>

      <?= $form->field($model, 'id')->hiddenInput(['value' => $model->id])->label(false); ?>
			<?= $form->field($model, 'payment_type')->hiddenInput(['value' => 'paypal'])->label(false); ?>
        <h2><?= Yii::t('frontend', 'Feature your hourlie');?></h2>
        <h4><?= Yii::t('frontend', 'Boost your sales');?></h4>

        <div class="benefits">
					<div class="col-md-12">
						<?= Yii::t('frontend', 'Feature your hourlie for just') .' '. Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()) . MyHelpers::FeatureHourliePrice() .' '. Yii::t('frontend', 'a week');?>
					</div>
					<br />
          <p><li class="fa fa-check"></li><span><?= Yii::t('frontend','Receive a featured logo');?></span></p>
          <p><li class="fa fa-check"></li><span><?= Yii::t('frontend','Placed at the top of results');?></span></p>
          <p><li class="fa fa-check"></li><span><?= Yii::t('frontend','Featured on home page');?></span></p>
          <p><li class="fa fa-check"></li><span><?= Yii::t('frontend','Recommedned on hourlies page');?></span></p>
        </div>
        <div class="featureperiod">
          <?= $form->field($model, 'promoted')->radioList(['1' => Yii::t('frontend', 'Feature for just one week'), '2' => Yii::t('frontend', 'Feature for a Month') , '3' => Yii::t('frontend', 'Feature for a Year')])->label(false); ?>
        </div>

        <div class="form-group text-center">
           <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Promote') : Yii::t('frontend', 'Promote'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
           <?= Html::a('Skip>>', ['hourlies/'.$SeoURL.'-'.$model->id]);?>
        </div>
      <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-4">
      <div class="text-center">
          <h2><strong><?= Yii::t('frontend', 'GET FEATURED');?></strong></h2>
        </div>
              <div class="tips">
                    <ol type="1" class="text-left">
                        <li><?= Yii::t('frontend', 'Receive more sales by staring at the top of the results');?></li>
                    </ol>
										<img src="/assets/images/featuredimg.png">
              </div>
        </div>

  </div>
</div>
