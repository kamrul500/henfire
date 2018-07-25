<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use app\models\HourliesSearch;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use dosamigos\multiselect\MultiSelect;
use yii\helpers\Url;
use common\components\MyHelpers;
$model = new HourliesSearch;

?>

    <aside id="fh5co-hero">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-8 col-md-offset-2 text-center">

    						<div class="dslider-text-inner" data-animate-effect="fadeIn">
    							<h1 class="maintitlefront"><?= MyHelpers::WebsiteName();?></h1>

                  <h4 class="subtitlefront"><?= MyHelpers::Websitetagline();?></h4>
                  <div class="spaced"></div>
    							<div class="row">

    										<?= $this->render('forms/index_search', ['model' => $model]) ?>

    							</div>
    						</div>
    				</div>
    			</div>
    		</div>
    	</aside>
<!--Hourlies-->
<div class="container">
  <div class="row>">
    <div class="spaced"></div>
    <h1 class="text-center">Explore The Marketplace</h1>
    <h4 class="text-center">Get inspired to build your business</h4>
  </div>
  <div class="spaced"></div>
  <div class="row text-center cat-frontend">
    <?= MyHelpers::categories();?>
  </div>
</div>
<div class="container-fluid freelancer-container">
  <div class="container">
    <div class="freelancer-reg">
      <div class="row">
        <div class="col-md-7">
          <h1><?= Yii::t('frontend', 'Register as a Freelancer');?></h1>
          <br />
          <h5>
            <?= Yii::t('frontend', 'Start earning revenue today from work that you complete');?>
          </h5>
          <br />
          <?= Html::a('Register', ['/user/register'], ['class'=>'btn btn-secondary btn-outline']) ?>
        </div>
        <div class="col-md-5">
          <!--<img src="assets/images/15190424546165560.png" height="86px" />-->
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row>">
    <div class="spaced"></div>
    <h1 class="text-center">Take The First Step</h1>
    <h4 class="text-center">Whatever your goal, here are a few places to get started</h4>
    <?= MyHelpers::categorie_pitures();?>
  </div>


</div>
<?php
$script = <<< JS
$(document).ready(function(){
   var scroll_start = 2;
   var startchange = $('.maintitlefront');
   var offset = startchange.offset();
    if (startchange.length){
   $(document).scroll(function() {
      scroll_start = $(this).scrollTop();
      if(scroll_start > offset.top) {
          $(".navbar-custom").addClass('scrolling-nav');
       } else {
          $('.navbar-custom').removeClass('scrolling-nav');
       }
   });
    }
});
JS;
$this->registerJs($script);
?>
