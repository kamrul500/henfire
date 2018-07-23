<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Hourlieworkstream */

$this->title = $model->job_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Job workstream'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hourlieworkstream-view">
<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="<?=MyHelpers::IdtoPic($model->freelancer_id);?>" alt="User profile picture">

          <h3 class="profile-username text-center"><?=MyHelpers::IdToFullName($model->freelancer_id);?></h3>

          <p class="text-muted text-center"><?= Yii::t('backend', 'Freelancer');?></p>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="<?=MyHelpers::IdtoPic($model->user_id);?>" alt="User profile picture">

          <h3 class="profile-username text-center"><?=MyHelpers::IdToFullName($model->user_id);?></h3>

          <p class="text-muted text-center"><?= Yii::t('backend', 'Customer');?></p>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- About Me Box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= Yii::t('backend', 'About this Job');?></h3>
        </div>
        <!-- /.box-header -->
        <?=$about;?>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">

          <li class="active"><a href="#timeline" data-toggle="tab">Timeline</a></li>
          <!--<li><a href="#settings" data-toggle="tab">Settings</a></li>-->
        </ul>
        <div class="tab-content">

          <!-- /.tab-pane -->
          <div class="active tab-pane" id="timeline">
            <!-- The timeline -->
            <ul class="timeline timeline-inverse">
              <!-- timeline time label -->
              <li class="time-label">
                    <span class="bg-red">
                      <?=Yii::t('backend', 'JOB STARTED').' '. $model->date;?>
                    </span>
              </li>
              <!-- /.timeline-label -->
              <?=$comments;?>
              <!-- END timeline item -->

              </li>
            </ul>
          </div>
          <!-- /.tab-pane -->

        <!--  <div class="tab-pane" id="settings">
            <form class="form-horizontal">
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>

                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputName" placeholder="Name">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputName" placeholder="Name">
                </div>
              </div>
              <div class="form-group">
                <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                <div class="col-sm-10">
                  <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-danger">Submit</button>
                </div>
              </div>
            </form>
          </div>-->
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

</section>
</div>
