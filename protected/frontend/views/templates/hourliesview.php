<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use edofre\sliderpro\models\Slide;
use edofre\sliderpro\models\slides\Image;
use common\components\MyHelpers;
use app\models\HourliesSales;
use app\models\HourliesReviews;
use app\models\Hourlies;
use app\models\User;
use yii\widgets\ActiveForm;
//use imanilchaudhari\CurrencyConverter\CurrencyConverter;
use kartik\widgets\TouchSpin;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use kartik\widgets\StarRating;

/* @var $this yii\web\View */
/* @var $model app\models\Hourlies */

$this->title = $model->title;

?>
<nav class="navbar-minimenu navbar" data-spy="affix" data-offset-top="30">
<div class="container-fluid">
  <ul class="nav navbar-nav">
    <?= MyHelpers::categori_menu_view();?>
  </ul>
</div>
</nav>
<div class="container">
<div class="hourlies-view">
<?= $updatebuton; ?>
	<div class="container">
		<div class="col-md-4 text-center pricebox">
			<div class="sticky-scroll-box">
			<h2><?= Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency).'<span class="round_price">'.round($price).'</span>'; ?></h2>
		<?php $form = ActiveForm::begin(
        ['options' => ['enctype' => 'multipart/form-data'],
        'method' => 'post',
        'action' => ['check-out/payment'],
        ]); ?>
				 <div class="col-md-5 spinnerbutton">
							<?= $form->field($sales, 'amount_bought')->widget(TouchSpin::classname(), [
        'options' => ['placeholder' => Yii::t('frontend','Adjust...')],
        'pluginOptions' => [
            'initval' => 1,
            'min' => 1,
            'max' => 99,
            'buttonup_class' => 'btn btn-default',
            'buttondown_class' => 'btn btn-default',
            'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>',
            'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>',
            ],
            'pluginEvents' => [
                'change' => 'function() {var num = $(this).val(); var price = '.round($price).'; var sum = num*price; $(".total").val(sum); $(".round_price").text(sum)}',
                ],

        ])->label(false); ?>
					</div>
				<div class="col-sm-7">

					<?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'BUY NOW'), ['class' => $model->isNewRecord ? 'widebutton btn btn-primary btn-lg' : 'widebutton btn btn-primary btn-lg']) ?>
					</div>
					<div class="clearfix"></div>
					<div class="usercreds">
					<div class="col-sm-2 col-sm-2 col-md-4">
							<div class="text-center iconaffix"><i class=" fa fa-paper-plane-o"></i></div>
						<div class="minitext"><?=Yii::t('frontend','Delivery in');?></div>
						<div><strong><?=$model->delivery_time; ?> <?=Yii::t('frontend','day');?><?=$plaural; ?></strong></div>
					</div>
					<div class="col-sm-2 col-sm-2 col-md-4">
						<div class="iconaffix text-center"><i class="fa fa-thumbs-o-up"></i></div>
						<div class="minitext"><?=Yii::t('frontend','Rating');?></div>
						<div><strong><?= $percent_friendly; ?></strong></div>
						<div>(<?=$numberOfReviews; ?> <?=Yii::t('frontend','Reviews');?>)</div>
					</div>
					<div class="col-sm-2 col-sm-2 col-md-4">
							<div class="iconaffix text-center"><i class="fa fa-clock-o"></i></div>
						<div class="minitext"><?=Yii::t('frontend','Response');?></div>
						<div><strong><?=Yii::t('frontend','Instantly');?></strong></div>
					</div>
					</div>
					<div class="clearfix"></div>
					<div class="hourliedata">
						<div class="views pull-left">
							<strong><?=$model->views; ?> <?=Yii::t('frontend','Views');?></strong>
						</div>
						<div class="sales text-right">
							<?= $mysales; ?> <?=Yii::t('frontend','Sales');?>
						</div>

					</div>
				</div>
			</div>
			<?= $form->field($model, 'user_id')->hiddenInput(['name' => 'seller_id', 'value' => $model->user_id])->label(false); ?>
			<?= $form->field($model, 'id')->hiddenInput(['value' => $model->id])->label(false); ?>
			<?= $form->field($model, 'title')->hiddenInput(['name' => 'title', 'value' => $model->title])->label(false); ?>
			<?= $form->field($model, 'cost')->hiddenInput(['name' => 'basecost', 'value' => $price])->label(false); ?>
			<?= $form->field($model, 'cost')->hiddenInput(['class' => 'total', 'value' => $price])->label(false); ?>
			<?= $form->field($model, 'sellers_currency')->hiddenInput(['name' => 'sellers_currency', 'value' => $mycurrency])->label(false); ?>
			<?= $form->field($model, 'origional_currency_price')->hiddenInput(['name' => 'origional_currency_price', 'value' => $model->cost])->label(false); ?>
		 <?php ActiveForm::end(); ?>


        	<div class="col-md-8">
            	<div class="">
            		<h2><?= Html::encode($this->title) ?></h2>
                </div>
								<hr>
            <?= \edofre\sliderpro\SliderPro::widget([
                'id' => 'my-slider',
                'sliderOptions' => [
                    'width' => 760,
                    'height' => 430,
                    'arrows' => false,
                                        'waitForLayers' => true,
                                        'thumbnailPointer' => true,
                                        'arrows' => true,
                                        'buttons' => false,
                                        'autoplay' => false,

                ],
            ]);
            ?>
                <div class="HourlieSlider" id="my-slider">
                    <div class="sp-slides">
                        <!-- Slide 1 -->
                        <?= $video; ?>
                        <?= $images; ?>

                        <!-- thumbnails -->
                        <div class="sp-thumbnails">
                        	<?= $videothumb; ?>
                            <?= $thumbnail; ?>
                        </div>
                    </div>
                </div>
                <h3 class="border_bottom whatyouget"><?=Yii::t('frontend','What you get with this Hourlie');?></h3>
                <p>
                  <?= $model->description; ?>
                </p>

								<h3 class="border_bottom"><?=Yii::t('frontend','What the seller needs to start work');?></h3>
                <p>
                  <?= $model->needed; ?>
                </p>

								<p><?=Yii::t('frontend','Reviews');?> (<?=$numberOfReviews; ?>)</p>

								<div class="review">
									<div class="timelineset">
			 <div class="line text-muted"></div>

			 <!-- Panel -->
			 <?= $review; ?>

	 </div>
	 <!-- /Timeline -->
								</div>

							</div>
            <div class="cleatfix"></div>
						<div class="col-md-4 bio paddingset">
							<div class="pic col-md-2">
			            <a href="../profile/<?= $model->user_id; ?>"><?= Html::img($profile_pic, ['class' => 'minipic']); ?></a>
			        </div>
							<div class="username col-md-10">
								<strong class="nodecor"><a href="../profile/<?= $model->user_id; ?>"><?=$fullname?></a></strong>
									<div><?= $occupation; ?></div>
			        </div>
						</div>
						<div class="col-md-4 paddingset">
							<div class="col-md-12"><?= $introduction; ?></div>
						</div>
						<div class="col-md-4 paddingset">
							<div class="col-md-9">
								<span class="fa fa-fw fa-map-marker"></span><?= $country; ?>
							</div>

						</div>
						<div class="col-md-4 satisfaction">
							<div class="col-md-4">
								<?= Html::img(Url::home(true).'assets/images/yUviuGV.png', ['height' => '75px']); ?>
							</div>
							<div class="col-md-7">
								<p><strong><?=Yii::t('frontend','Money protection gurantee');?></strong></p>
								<p class="moneyback"><?=Yii::t('frontend','Job done or your money back');?></p>
							</div>

						</div>

					<div class="col-md-4">

												<div class="profile_heading">
														<h5><strong><?=Yii::t('frontend','Also from this Freelancer');?></strong></h5>
												</div>
												<?= ListView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'emptyText' => Yii::t('frontend','No others'),
                                                    'itemView' => '@app/views/templates/forms/_grids/_myhourlies',
                                                    'itemOptions' => ['class' => ''],
                                                    'layout' => '{items}<div>{pager}</div>',
                                                ]); ?>
					</div>
    </div>
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title"><?=Yii::t('frontend','About');?><?= $fullname; ?></h4>
		      </div>
		      <div class="modal-body">
		        <p><?= $introduction; ?></p>
		      </div>
		    </div>

		  </div>
		</div>
</div>
</div>

<?php $script = <<<JS
$(document).ready(function () {
	$('.navbar .dropdown').hover(function() {
			  $(this).find('.dropdown-menu').first().stop(true, true).slideDown(150);
			}, function() {
			  $(this).find('.dropdown-menu').first().stop(true, true).slideUp(105)
			});
  //var top = $('.sticky-scroll-box').offset().top - 90;
  //$(window).scroll(function (event) {
  //  var y = $(this).scrollTop();
  //  if (y >= top)
  //    $('.sticky-scroll-box').addClass('fixed');
  //  else
  //    $('.sticky-scroll-box').removeClass('fixed');
  //  $('.sticky-scroll-box').width($('.sticky-scroll-box').parent().width());
  //});
});
JS;
$this->registerJs($script);
?>
