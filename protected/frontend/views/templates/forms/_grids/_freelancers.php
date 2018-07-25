<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\User;
//use imanilchaudhari\CurrencyConverter\CurrencyConverter;
use common\components\MyHelpers;

/*encoded tags*/
$id = Html::encode($model->id);

//if (Yii::$app->user->isGuest) {
    $mycurrency = MyHelpers::Currency();
//} else {
  //  $mycurrency = Yii::$app->user->identity->currency;
//}
//$theircurrency = $model->currency;

//$converter = new CurrencyConverter();
//$rate = $converter->convert($theircurrency, $mycurrency);

$price = $model->hourlie_rate;

$splitted = explode(',', $model->skills);
if(empty($model->skills))
{
  $skillcount = 0;
}
else {
  foreach ($splitted as $i => $key) {
      $i > 0;
      $skillcount = $i - 6;
  }
}
$skillsoutput = array_slice($splitted, 0, 7);
$skills = json_decode(json_encode($skillsoutput), true);

$av_now = '';
if ($model->available_now == 1) {
    $av_now = '<span class="fa fa-fw fa-check-circle green"></span> Available now';
}
$full_name = preg_replace("/[^\w]+/", '-', $model->full_name);
?>
		    <div class="col-md-2 col-xs-6 pic">
            <a href="<?=Url::home(true)?>profile/<?= $full_name.'-'. $model->id; ?>"><?= Html::img($model->profile_picture, ['class' => 'freelance_profile_picture']); ?></a>
        </div>

        <div class="col-md-2 col-xs-6 text-right setrate">
          <div class="hourlie_rate">
        	   <h3><?= Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency).' '.round($price); ?></h3>
             <p><?=Yii::t('frontend', 'Per Hour');?></p>
           </div>
        	<div class="cnt_button"><?= Html::a(Yii::t('frontend', 'Invite to job'), ['/invite/member/'.$model->id], ['class' => 'btn btn-default']) ?></div>
		    </div>

        <div class="col-md-8">
            <div class="freelancer-username">
                <a href="<?=Url::home(true)?>profile/<?= $full_name.'-'. $model->id; ?>"><?=$model->full_name?></a> <?= MyHelpers::isonline($model->id); ?> <?= $av_now; ?>
            </div>
            <div class="freelancer-occupation">
            <span><?= $model->occupation; ?></span>
            </div>

            <div class="freelancer-country">
               <span class="fa fa-fw fa-map-marker"></span> <?=$model->country.', '.$model->town ?> <a href="<?=Url::home(true)?>profile/<?= $full_name.'-'. $model->id; ?>"><span class="fa fa-fw fa-briefcase"></span> VIEW PORTFOLIO</a>
            </div>
        </div>

                <div class="tag_list col-md-9 col-xs-12 col-sm-12">
                            <ul class="tags">
                <?php
                foreach ($skills as $value) {
                    echo '<li><a href="?FreelancerSearch[skills]='.$value.'" class="tag">'.$value.'</a></li>';
                }
                ?>
                </ul>
                <a href="<?=Url::home(true)?>profile/<?= $full_name.'-'.$model->id; ?>"><?= $skillcount.' '. Yii::t('frontend', 'more skills'); ?></a>
                </div>
