<?php
use yii\helpers\Html;
use app\models\JobProposals;
use common\components\MyHelpers;

?>

<?php
//if (Yii::$app->user->isGuest) {
    $mycurrency = MyHelpers::Currency();
//} else {
    //$mycurrency = Yii::$app->user->identity->currency;
//}
$setlevel = Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency).''.Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency).''.Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency);

if ($model->experience_level == 1) {
    $setlevel = Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency);
} elseif ($model->experience_level == 2) {
    $setlevel = Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency).''.Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency);
} elseif ($model->experience_level == 3) {
    $setlevel = Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency).''.Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency).''.Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency);
}
$proposals = JobProposals::find()->where(['job_id' => $model->id])->all();
$myproposals = count($proposals);

$string = preg_replace("/[^\w]+/", '-', $model->title);
$SeoURL = strtolower($string);

?>

<div class="jobtitles">
  <h4><a href="./job/<?=$SeoURL.'-'.$model->id; ?>"><?=$model->title; ?></a></h4>
</div>
<div class="joblevel"><?=$setlevel; ?></div>
<div class="listedjob">
<span class="fa fa-fw fa-clock-o"></span><?=MyHelpers::timeAgo($model->date_created); ?>
<span class="fa fa-fw fa-map-marker"></span><?=Yii::t('frontend', 'Remote');?>
<span class="fa fa-fw fa-dot-circle-o"></span><?=Yii::t('frontend', 'Proposals');?> <?=$myproposals; ?>
<span class="fa fa-fw fa-clock-o"></span><?=$model->worktype; ?> <?=Yii::t('frontend', 'Price');?>
<div class="pull-right"><?= Html::a(Yii::t('app', 'SEND PROPOSAL'), ['./job/'.$SeoURL.'-'.$model->id], ['class' => 'btn btn-warning']) ?></div>
<div class="clearFix"></div>
<?=$model->date_created;?>
</div>
