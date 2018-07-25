<?php
use yii\helpers\Html;
use yii\helpers\Url;
//use imanilchaudhari\CurrencyConverter\CurrencyConverter;
use common\components\MyHelpers;

/*encoded tags*/
$id = Html::encode($model->id);

$mainIMG = json_decode($model->images);
if(empty($mainIMG[0])){
  $mainIMG[0] = Url::base().'/assets/images/No_Image_Available.jpg';
}
$string = preg_replace("/[^\w]+/", '-', $model->title);
$SeoURL = strtolower($string);

    $name = Yii::$app->db->createCommand('SELECT * FROM {{%user}} WHERE id="'.$model->user_id.'"');
    $reader = $name->query();
    $dataUser = $reader->readAll();
    $fullname = $dataUser[0]['full_name'];
    $currency = $dataUser[0]['currency'];
    $mycurrency = MyHelpers::Currency();
    /*if (Yii::$app->user->isGuest) {
        $mycurrency = MyHelpers::Currency();
    } else {
        $mycurrency = Yii::$app->user->identity->currency;
    }
    $theircurrency = $currency;

    $converter = new CurrencyConverter();
    $rate = $converter->convert($theircurrency, $mycurrency);*/

    $price = $model->cost;
    $imghtml = Html::img($mainIMG[0], ['class' => 'Imgstretch']);
?>
<div class="promoting">
	<div class="col-me-12">
		<div class="col-md-4">
				<?= Html::a($imghtml, [$SeoURL.'-'.$id]); ?>
		</div>
		<div class="col-md-8">
				<?= Html::a($model->title, [$SeoURL.'-'.$id]); ?>
		</div>
		<div class="smalprice pull-right col-md-2">
			<div class="pricetext">
				<?= Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency).$price; ?>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<br />
