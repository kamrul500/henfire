<?php

use yii\helpers\Html;
use app\models\User;
use common\components\MyHelpers;

$job_id = Html::encode($model->job_id);
$user_id = Html::encode($model->user_id);
$price = Html::encode($model->price);
$comment = Html::encode($model->comment);
$date = Html::encode($model->date);
$name = Yii::$app->db->createCommand('SELECT * FROM {{%user}} WHERE id="'.$user_id.'"');
$reader = $name->query();
          $dataUser = $reader->readAll();

		  $profile_pic = $dataUser[0]['profile_picture'];
          $currency = $dataUser[0]['currency'];
          $fullname = $dataUser[0]['full_name'];
          $occupation = $dataUser[0]['occupation'];
          $introduction = $dataUser[0]['introduction'];
          $country = $dataUser[0]['country'];
          $url_name = preg_replace("/[^\w]+/", '-', $dataUser[0]['full_name']);

$mycurrency = MyHelpers::Currency();
//do not edit above this
?>

<div class="user_pic pic col-md-2">
	<?= Html::img($profile_pic, ['class' => 'freelance_profile_picture']);?>
</div>
<div class="col-md-10">
	<div class="name col-md-8">
	<h3><?= $fullname;?></h3>
    <h5><?= $country;?></h5>
	</div>
    <div class="col-md-4">
    	<h3><?= Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency);?><?= $price;?></h3>
    </div>
</div>
<div class="col-md-10">
    <div class="col-md-8 prop-comment">
    	<?= substr($comment, 0, 199);?>
    </div>

    <div class="col-md-1">

        <div class="cnt_button"><?= Html::a(Yii::t('frontend', 'Reply'), ['job-proposals/view?id='.$model->id], ['class' => 'btn btn-warning']) ?></div>
    </div>
    <div class="col-md-1">
    	<div class="cnt_button"><?= Html::a(Yii::t('frontend', 'Accept'), ['job-proposals/accept?id='.$model->id], ['class' => 'btn btn-success']) ?></div>
    </div>
</div>
