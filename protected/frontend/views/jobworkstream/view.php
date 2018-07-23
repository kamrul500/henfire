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
              <li class="active"><a href="#timeline" data-toggle="tab">Timeline</a></li>

            </ul>
            <div class="tab-content">
              <!-- /.tab-pane -->
              <div class="active tab-pane" id="timeline">
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
                    <?= $jobfinished;?>


                    <?=$jobstarted;?>
                    <?=$timeline;?>

                  </li>
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
          <?php if($completed != 1 ) {?>
          <div class="workflowreply">
            <?php $form = ActiveForm::begin(['action' => ['jobworkstream/'.$model->job_id],'options' => ['method' => 'post', 'enctype' => 'multipart/form-data']]) ?>
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
              <h2 class="text-muted text-center"><?=Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()) . $jobprice;?></h2>

                <?php if(MyHelpers::IsFreelancer($idtoshow) == 0 && $model->is_finished == 0){
                  $form = ActiveForm::begin(['action' => ['jobworkstream/completed?id='.$model->job_id],'options' => ['method' => 'post', 'enctype' => 'multipart/form-data']]);
                  echo  Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Request Payment'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary btn-block']);
                  ActiveForm::end();
                 }
                 elseif(MyHelpers::IsFreelancer($idtoshow) == 0 && $model->is_finished == 1 && $completed == 0) {
                   echo '<button type="button" class="btn btn-block btn-warning btn-flat disabled">Payment Request Sent</button>';
                 }
                 elseif(MyHelpers::IsFreelancer($idtoshow) == 1 && $model->is_finished == 1 && $completed == 0) {
                   $form = ActiveForm::begin(['action' => ['jobworkstream/authorized?id='.$model->job_id],'options' => ['method' => 'post', 'enctype' => 'multipart/form-data']]);
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
