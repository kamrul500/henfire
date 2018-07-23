<?php
use yii\helpers\Html;
use app\models\JobProposals;
use common\components\MyHelpers;
use app\models\User;
use yii\helpers\Url;

$this->title = $model->title;
if (Yii::$app->user->isGuest) {
    $proposalview = '<div class="col-md-12">'.Yii::t('frontend', 'You must be a freelancer to send a proposal').' <a href="../user/register">'.Yii::t('frontend', 'Signup').'</a></div>';
} else {
    $user_id = Yii::$app->user->identity->id;
    $userproposals = JobProposals::find()->where(['user_id' => $user_id, 'job_id' => $model->id])->all();
    if (empty($userproposals)) {
        $proposalview = $this->render('@app/views/templates/forms/job_proposal', [
        'model' => $model,
    ]);
    } else {
        $proposalview = $this->render('@app/views/templates/forms/job_myproposal', [
        'model' => $model,
    ]);
    }
}
?>
<div class="myjob-view container">
      <div class="col-md-9">
        <div class="listedjobtitle">
        <h1><?= Html::encode($this->title) ?></h1>
        </div>
          <span class="fa fa-fw fa-clock-o"></span><?= Yii::t('frontend', 'Posted');?> <strong><?=MyHelpers::timeAgo($model->date_created); ?><?= Yii::t('frontend', 'ago');?></strong> <span class="fa fa-fw fa-map-marker"></span><?= Yii::t('frontend', 'Remote');?>
          <span class="fa fa-fw fa-dot-circle-o"></span><?= Yii::t('frontend', 'Proposals');?> <?=$myproposals; ?> <span class="pull-right">#<?=$model->id;?></span>

          <div class="proposalsheaderlist">
            <?=$listedprops;?>
          </div>

          <h3 class="descmargin"><?= Yii::t('frontend', 'Description');?></h3>
          <strong><?= Yii::t('frontend', 'Experience Level:');?></strong> <?=$setlevel; ?>

          <p><?=$model->description; ?></p>
          <div id="target"></div>
          <br />
          <h3><?= Yii::t('frontend', 'Proposals');?></h3>

          <?=$proposalview; ?>
      </div>


      <!--right hand panel-->
      <div class="col-md-3 rightsidepanel text-center pull-right">
        <div class="col-md-12">
          <div class="col-md-6">
            <div class="jobrighttitle">
              <?=Yii::t('frontend', 'ENDS IN');?>
            </div>
            <div class="jobrightsum">
              <?=MyHelpers::timeAgo($model->date_expire); ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="jobrighttitle">
              <?=Yii::t('frontend', 'BUDGET');?>
            </div>
            <div class="jobrightsum">
              <?=Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()) . $model->budget; ?>
            </div>
          </div>
          <div class="clearfix"></div>
          <a href="#target"><button type="button" class="btn btn-warning rightpanelbutton"><?= Yii::t('frontend', 'Send Proposal');?></button></a>
          <div class="text-center">-or-</div>
          <div class="cnt_button"><?= Html::a(Yii::t('frontend', 'Create one like this'), ['new?r=post_new_job'], ['class' => 'btn btn-warning rightpanelbutton']) ?></div>
          <div class="rightprofile">
            <div class="pull-left">
              <?= Html::img($memberprofile_pic, ['class' => 'timelinepiclarge']);?>
            </div>
            <div class="rightprofilename pull-left">
              <strong><?= $memberfull_name;?></strong>
            </div>
            <div class="jobisonline">
              <?=MyHelpers::isonline($model->user_id);?>
            </div>
            <div class="rightprofilecountry text-left">
              <strong><?=$membercountry;?></strong>
            </div>

          </div>
        </div>
      </div>
      <!--end of right hand panel-->
</div>
