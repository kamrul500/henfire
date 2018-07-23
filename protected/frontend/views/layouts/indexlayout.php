<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use kartik\nav\NavX;
use common\components\MyHelpers;

rmrevin\yii\fontawesome\AssetBundle::register($this);

AppAsset::register($this);
if (class_exists('frontend\assets\AppAsset')) {
    backend\assets\AppAsset::register($this);
} else {
    app\assets\AppAsset::register($this);
}

dmstr\web\AdminLteAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
if (!Yii::$app->user->isGuest) {
$isfreelancer = MyHelpers::IsFreelancer(yii::$app->user->identity->id);
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Html::encode( Yii::$app->language) ?>">
<head>
    <?= MyHelpers::Analytics();?>
    <meta charset="<?= Html::encode(Yii::$app->charset) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta name="description" content="<?= MyHelpers::Websitetagline();?>">
    <meta name="keywords" content="<?= MyHelpers::WebsiteKeywords();?>">
    <?php $this->head() ?>
<!--SUPPORT CSS-->
<style type="text/css">
#floating_link {
     position: fixed;
     right: 0;
     top: 400px;
     display: block;
     width: 50px;
     height: 200px;
     text-indent: -10000px;
     background-image: url(/assets/images/support.png);
     background-repeat: no-repeat;
     overflow: hidden;
}

</style>

</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
  <div class="container">

    <?php
    if (empty(MyHelpers::WebsiteLogo())) {
        $logo = MyHelpers::WebsiteName();
    } else {
        $logo = Html::img(MyHelpers::WebsiteLogo(), ['alt' => MyHelpers::WebsiteName()]);
    }
    NavBar::begin([
        'brandLabel' => $logo,
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions' => ['class' => 'container-fluid'],
        'options' => [
            'class' => 'navbar-custom navbar-fixed-top',
        ],
    ]);


        if($isfreelancer == 1)
        {
          $menuItems[] = ['label' => Yii::t('frontend', 'POST HOURLIE'), 'url' => ['/hourlies/create?r=post_new_hourlie'],'options'=>['class'=>'postjob_style']];
        }
        else {
          $menuItems[] = ['label' => Yii::t('frontend', 'POST JOB'), 'url' => ['/job/new?r=post_new_job'],'options'=>['class'=>'postjob_style']];
        }
        //$menuItems[] = ['label' => Yii::t('frontend', 'POST JOB'), 'url' => ['/job/new?r=post_new_job'],'options'=>['class'=>'postjob_style']];


    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '<span class="fa fa-fw fa-user-plus"></span>'.Yii::t('frontend', 'Signup'), 'url' => ['/user/registration/register']];
        $menuItems[] = ['label' => '<span class="fa fa-fw fa-unlock"></span>'. Yii::t('frontend', 'Login'), 'url' => ['/user/security/login']];
    } else {
        $menuItems[] = ['label' => '<span>'.Html::img(Yii::$app->user->identity->profile_picture, ['class' => 'timelinepic']).'</span> <span>'.Yii::$app->user->identity->username.'</span>', 'active' => false, 'items' => [

            /*['label' => '<span class="fa fa-fw fa-tachometer"></span>'.Yii::t('frontend', 'Dashboard'), 'url' => ['/dashboard']],*/
            '<div class="profnav">',
            '<div class="col-xs-7 col-sm-7 navborderprofile">',
            ['label' => '<span class="fa fa-fw fa-user"></span>'.Yii::t('frontend', 'Profile'), 'url' => ['/profile']],
            '</div>',
            '<div class="col-xs-4 col-sm-4">',
            ['label' => Yii::t('frontend', 'Edit'), 'url' => ['/profile/update']],
            '</div>',
            '</div>',
            ['label' => '<span class="fa fa-fw fa-shopping-cart"></span>'.Yii::t('frontend', 'Activiy'), 'url' => ['/hourlies/manage']],
            ['label' => '<span class="fa fa-fw fa-money"></span>'.Yii::t('frontend', 'Payments'), 'url' => ['/payments']],


            '<li class="divider"></li>',
           ['label' => '<span class="fa fa-fw fa-sign-out"></span>'.Yii::t('frontend', 'Logout').' ('.Yii::$app->user->identity->username.')', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
        ]];
    }
    ?>
    <ul class="navbar-nav navbar-right nav">
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="fa fa-globe"></span> <b class="caret"></b></a>
                <?= \common\widgets\LanguageDropdown::widget() ?>
            </li>
        </ul>

     <?= NavX::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
    'activateParents' => true,
    'encodeLabels' => false,
    ]);
    NavBar::end();
    ?>

  </div>
  <div class="widget">
        <?= Alert::widget() ?>
  </div>

<div class="contentset">
        <?= $content ?>
</div>

  </div>

<footer id="fh5co-footer">

  <div class="container">
    <div class="col-md-3 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
      <h3>About Us</h3>
      <p><?=Yii::t('frontend', 'Providing great work at great prices, bringing together freelancers and buyers into one market place');?></p>

    </div>
    <div class="col-md-6 col-md-push-1 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
      <h3>Our Services</h3>
      <ul class="float">
        <li><a href="../hourlies">Buy Hourlies</a></li>
        <li><a href="../freelancer">Find Freelancers</a></li>
        <li><a href="../freelance-jobs">Browse Jobe</a></li>

      </ul>
    </div>

    <div class="col-md-2 col-md-push-1 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
      <h3>Follow Us</h3>
      <ul class="fh5co-social">
        <li><a href="<?= Html::encode(MyHelpers::Twitter());?>"><i class="icon-twitter"></i></a></li>
        <li><a href="<?= Html::encode(MyHelpers::Facebook());?>"><i class="icon-facebook"></i></a></li>
        <li><a href="<?= Html::encode(MyHelpers::Google());?>"><i class="icon-google-plus"></i></a></li>
      </ul>
    </div>

    <div class="col-md-12 fh5co-copyright text-center">
      <p>&copy; 2016 <?= Html::encode(MyHelpers::WebsiteName());?>. All Rights Reserved. <span>Created by <a href="https://stralixprojects.com" target="_blank">StralixProjects.com</a></span></p>
    </div>

  </div>
</footer>



<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
