<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use common\components\MyHelpers;
use Symfony\Component\Intl\Intl;

/* @var $this yii\web\View */
/* @var $model app\models\Hourlieworkstream */

$this->title = Yii::t('frontend','Workstream');

?>

<div class="container">
  <div class="hourlies-view">
    <section class="content">
	   <div class="container">
      <div class="col-md-12">
        <div class="col-md-9">
          <div class="row">
          <div class="worksreamname">
            <h2><?= Html::encode($hourliename)?><h2>
          </div>
        </div>
          <hr>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="<?=$activetimeline;?>"><a href="#timeline" data-toggle="tab">Timeline</a></li>
              <li class="<?=$activereview;?>"><a href="#settings" data-toggle="tab">Review</a></li>
            </ul>
            <div class="tab-content">
              <!-- /.tab-pane -->
              <div class="<?=$activetimeline;?> tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          <?=Yii::t('frontend', 'JOB STARTED').' '. $model->date;?>
                        </span>
                  </li>
                  <li>
                    <!-- timeline Goes here -->
                    <?= $Hourliefinished;?>


                    <?=$jobstarted;?>
                    <?=$timeline;?>

                  </li>
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="<?=$activereview;?> tab-pane" id="settings">
                <!--Here we will allow the Member to review the Freelancer-->
                <?php if(MyHelpers::IsFreelancer($idtoshow) == 1  && $completed == 1 ):?>
                <?php $form = ActiveForm::begin(['action' => ['hourlies-reviews/create'],'options' => ['class' => 'form-horizontal','method' => 'post', 'enctype' => 'multipart/form-data']]) ?>
                <?= $form->field($thereview, 'hourlie_id')->hiddenInput(['value' => $item_id])->label(false); ?>
                <?= $form->field($thereview, 'user_id')->hiddenInput(['value' => $buyer_id])->label(false); ?>
                <?= $form->field($thereview, 'freelancer_id')->hiddenInput(['value' => $seller_id])->label(false); ?>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?=Yii::t('frontend', 'Rating');?></label>

                    <div class="col-sm-2">
                      <?php $rating = ['1' => Yii::t('backend','1'), '2' => Yii::t('backend','2'), '3' => Yii::t('backend','3'),
                      '4' => Yii::t('backend','4'), '5' => Yii::t('backend','5')]; ?>
                       <?= $form->field($thereview, 'rating')->dropDownList($rating, ['class' => 'form-control'])->label(false); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label"><?=Yii::t('frontend', 'Review');?></label>

                    <div class="col-sm-10">
                      <?= $form->field($thereview, 'review')->widget(\bizley\quill\Quill::className(), [])->label(false); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> <?=Yii::t('frontend', 'I agree to the');?> <a href="#"><?=Yii::t('frontend', 'Terms and Confitions');?></a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger"><?=Yii::t('frontend', 'Submit Review');?></button>
                    </div>
                  </div>
                <?php ActiveForm::end(); ?>
                <!--Here we will allow the Freelancer to review the member-->
              <?php elseif(MyHelpers::IsFreelancer($idtoshow) == 0  && $completed == 1 ):?>
                <?php $form = ActiveForm::begin(['action' => ['userreviews/create'],'options' => ['class' => 'form-horizontal','method' => 'post', 'enctype' => 'multipart/form-data']]) ?>

                <?= $form->field($userreview, 'user_id')->hiddenInput(['value' => $buyer_id])->label(false); ?>
                <?= $form->field($userreview, 'reviewr_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false); ?>
                <?= $form->field($userreview, 'hourlie')->hiddenInput(['value' => '1'])->label(false); ?>
                <?= $form->field($userreview, 'project_id')->hiddenInput(['value' => $item_id])->label(false); ?>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?=Yii::t('frontend', 'Rating');?></label>

                    <div class="col-sm-2">
                      <?php $rating = ['1' => Yii::t('backend','1'), '2' => Yii::t('backend','2'), '3' => Yii::t('backend','3'),
                      '4' => Yii::t('backend','4'), '5' => Yii::t('backend','5')]; ?>
                       <?= $form->field($userreview, 'rating')->dropDownList($rating, ['class' => 'form-control'])->label(false); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label"><?=Yii::t('frontend', 'Review');?></label>

                    <div class="col-sm-10">
                      <?= $form->field($userreview, 'review')->widget(\bizley\quill\Quill::className(), [])->label(false); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> <?=Yii::t('frontend', 'I agree to the');?> <a href="#"><?=Yii::t('frontend', 'Terms and Conditions');?></a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger"><?=Yii::t('frontend', 'Submit Review');?></button>
                    </div>
                  </div>
                <?php ActiveForm::end(); ?>
                <?php endif;?>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
          <?php if($completed != 1 ) {?>
          <div class="workflowreply">
            <?php $form = ActiveForm::begin(['action' => ['hourlieworkstream/update?id='.$model->job_id],'options' => ['method' => 'post', 'enctype' => 'multipart/form-data']]) ?>
            <?= $form->field($postcomment, 'upload')->fileInput() ?>
            <?= $form->field($postcomment, 'comment')->widget(\bizley\quill\Quill::className(), []) ?>
            <?= Html::submitButton('Submit') ?>
            <?php ActiveForm::end(); ?>
          </div>
        <?php };?>
        </div>
        <div class="col-md-3 pull-right">
          <div class="box">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?=MyHelpers::IdToPic($idtoshow);?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?=MyHelpers::IdToFullName($idtoshow);?></h3>
              <p class="text-muted text-center"><?=MyHelpers::IdToOccupation($idtoshow);?></p>
              <p class="text-muted text-center"><?=MyHelpers::isonline($idtoshow);?></p>
              <h2 class="text-muted text-center"><?=Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()) . $hourlieprice;?></h2>

                <?php if(MyHelpers::IsFreelancer($idtoshow) == 0 && $model->is_finished == 0){
                  $form = ActiveForm::begin(['action' => ['hourlieworkstream/completed?id='.$model->job_id],'options' => ['method' => 'post', 'enctype' => 'multipart/form-data']]);
                  echo  Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Request Payment'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary btn-block']);
                  ActiveForm::end();
                 }
                 elseif(MyHelpers::IsFreelancer($idtoshow) == 0 && $model->is_finished == 1 && $completed == 0) {
                   echo '<button type="button" class="btn btn-block btn-warning btn-flat disabled">Payment Request Sent</button>';
                 }
                 elseif(MyHelpers::IsFreelancer($idtoshow) == 1 && $model->is_finished == 1 && $completed == 0) {
                   $form = ActiveForm::begin(['action' => ['hourlieworkstream/authorized?id='.$model->job_id],'options' => ['method' => 'post', 'enctype' => 'multipart/form-data']]);
                   echo  Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Release Escrow'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary btn-block']);
                   ActiveForm::end();
                 }
                 elseif(MyHelpers::IsFreelancer($idtoshow) == 0  && $completed == 1 ) {
                   echo '<button type="button" class="btn btn-block btn-success btn-flat disabled">Escrow Released</button>';
                 }
                 elseif(MyHelpers::IsFreelancer($idtoshow) == 1  && $completed == 1 ) {
                   echo '<button type="button" class="btn btn-block btn-success btn-flat disabled">Project Complete</button>';
                 }?>
            </div>
            <!-- /.box-body -->
          </div>
      </div>
        </div>
      </div>
      </section>
    </div>
  </div>
