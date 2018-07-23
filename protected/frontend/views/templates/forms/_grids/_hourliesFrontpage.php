<?php
use yii\helpers\Html;
use app\models\User;
use app\models\HourliesSales;
use app\models\HourliesReviews;
//use imanilchaudhari\CurrencyConverter\CurrencyConverter;
use common\components\MyHelpers;

/*encoded tags*/
$id = Html::encode($model->id);

$mainIMG = json_decode($model->images);
$featured = '';
if ($model->promoted == 1) {
    $featured = '<img src="'.Yii::$app->homeUrl.'assets/images/featured.png" class="featured">';
}

$string = preg_replace("/[^\w]+/", '-', $model->title);
$SeoURL = 'hourlies/'.strtolower($string);

$userdetails = User::find()->where(['id' => $model->user_id])->all();
foreach($userdetails as $userdata)
{
    $fullname = $userdata['full_name'];
    $profile_pic = $userdata['profile_picture'];
    $country = $userdata['country'];
    $currency = $userdata['currency'];
    $rating = $userdata['rating'];
    $full_name = preg_replace("/[^\w]+/", '-', $userdata['full_name']);
}
    $mycurrency = MyHelpers::Currency();
    //if (Yii::$app->user->isGuest) {
        //$mycurrency = MyHelpers::Currency();
    //} else {
        //$mycurrency = Yii::$app->user->identity->currency;
    //}
    //$theircurrency = $currency;
    //$converter = new CurrencyConverter();
    //$rate = $converter->convert($theircurrency, $mycurrency);
    //$rate = MyHelpers::CurrencyExchange($theircurrency, $mycurrency);
    $price = $model->cost;

?>
<?= $featured; ?>
<?php
$imghtml = Html::img($mainIMG[0], ['class' => 'Imgstretch']);

$reviewset = new HourliesReviews();
$reviewsetdb = HourliesReviews::find()->where(['hourlie_id' => $model->id])->all();
$myreviews = count($reviewsetdb);
$reviewrating = array();
foreach ($reviewsetdb as $data) {
  $reviewrating[] = $data['rating'];
}
$percent_friendly = '0%';
if(count($reviewrating)>0)
{
$reviewratingsum = array_sum($reviewrating) / count($reviewrating);
$x = $reviewratingsum;
$y = 5;

$percent = $x / $y;
$percent_friendly = round(number_format($percent * 100, 2)).'%';
}

    $sales = new HourliesSales();
    $salesdb = HourliesSales::find()->where(['item_id' => $model->id])->all();
    $mysales = count($salesdb);

$displayhourlie = '<div class="overbox">
    <div class="pull-left">
     <div class="title overtext text-center"> <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> </div>
      <div class="tagline overtext text-center">'.Yii::t('frontend', 'Rated'). $percent_friendly.' </div>
    </div>
    <div class="pull-right">
      <div class="title overtext text-center"> <i class="fa fa-shopping-basket" aria-hidden="true"></i> </div>
      <div class="tagline overtext text-center">'.Yii::t('frontend', 'Sold'). $mysales.'</div>
    </div>
</div>';
?>
	<div class="HourlieImage">
		<?= Html::a($imghtml, [$SeoURL.'-'.$id]); ?>
    <?= Html::a($displayhourlie, [$SeoURL.'-'.$id]); ?>

 </div>
    <div class="HourlieTitle">
    	<strong><?= Html::a($model->title, [$SeoURL.'-'.$id]); ?></strong>
    </div>
    <div class="HourlieCost">
      <?= Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency).' '.round($price); ?>
    </div>
    <div class="contact">
        <div class="pic">
            <a href="../profile/<?=$full_name.'-'.$model->user_id; ?>"><?= Html::img($profile_pic, ['class' => 'minipic']); ?></a>
        </div>
        <div class="username">
			<a href="../profile/<?= $model->user_id; ?>"><?=$fullname?></a>
        </div>
        <div class="country">
			<?= Yii::t('frontend', $country )?>
        </div>
        <div class="cnt_button"><?= Html::a(Yii::t('frontend', 'Buy'), [$SeoURL.'-'.$id], ['class' => 'btn btn-warning']) ?></div>
    </div>
