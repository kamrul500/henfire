<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\form\ActiveForm;
use kartik\widgets\FileInput;
use common\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Hourlies */

$this->title = Yii::t('backend', 'Profile') . MyHelpers::IdToName($model->id);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Members'), 'url' => ['/members']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">

  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="<?=MyHelpers::IdToPic($model->id);?>" alt="User profile picture">

          <h3 class="profile-username text-center"><?=MyHelpers::IdToName($model->id)?></h3>

          <p class="text-muted text-center"><?=$model->company_name;?></p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b><?=Yii::t('backend', 'Status');?></b> <a class="pull-right"><?=MyHelpers::isonline($model->id);?></a>
            </li>
            <li class="list-group-item">
              <b><?=Yii::t('backend', 'Hourlies Bought');?></b> <a class="pull-right"><?=MyHelpers::hourliessales($model->id);?></a>
            </li>
            <li class="list-group-item">
              <b><?=Yii::t('backend', 'Jobs Created');?></b> <a class="pull-right"><?=MyHelpers::JobsCreated($model->id);?></a>
            </li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- About Me Box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?=Yii::t('backend', 'About Me');?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <strong><i class="fa fa-book margin-r-5"></i> <?=Yii::t('backend', 'Full Name');?></strong>

          <p class="text-muted">
            <?=MyHelpers::IdToFullName($model->id)?>
          </p>

          <hr>

          <strong><i class="fa fa-map-marker margin-r-5"></i> <?=Yii::t('backend', 'Location');?></strong>

          <p class="text-muted"><?=$model->country;?></p>

          <hr>

          <strong><i class="fa fa-file-text-o margin-r-5"></i><?=Yii::t('backend', 'Introduction');?></strong>

          <p><?=$model->introduction;?></p>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#hourlies" data-toggle="tab"><?=Yii::t('backend', 'Hourlies Bought');?></a></li>
          <li><a href="#jobs" data-toggle="tab"><?=Yii::t('backend', 'Jobs Created');?></a></li>
          <li><a href="#settings" data-toggle="tab"><?=Yii::t('backend', 'Settings');?></a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="hourlies">
            <table id="hourliestable" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th><?=Yii::t('backend', 'Hourlie Name');?></th>
                <th><?=Yii::t('backend', 'Cost');?></th>
                <th><?=Yii::t('backend', 'Amount Bought');?></th>
                <th><?=Yii::t('backend', 'Total Cost');?></th>
                <th><?=Yii::t('backend', 'Paid Status');?></th>
                <th><?=Yii::t('backend', 'Completed');?></th>

              </tr>
              </thead>
              <tbody>
                <?=$myboughthourlies;?>
              </tbody>
            </table>

          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="jobs">
            <!-- The timeline -->
            <table id="jobtable" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th><?=Yii::t('backend', 'Title');?></th>
                <th><?=Yii::t('backend', 'Status');?></th>
                <th><?=Yii::t('backend', 'User');?></th>
                <th><?=Yii::t('backend', 'Freelancer');?></th>
                <th><?=Yii::t('backend', 'Budget');?></th>
                <th><?=Yii::t('backend', 'Category');?></th>
                <th><?=Yii::t('backend', 'Date Created');?></th>
                <th><?=Yii::t('backend', 'Date Expire');?></th>
                <th><?=Yii::t('backend', 'Promoted');?></th>
                <th><?=Yii::t('backend', 'Escro');?></th>
                <th><?=Yii::t('backend', 'Issues');?></th>
                <th><?=Yii::t('backend', 'View');?></th>

              </tr>
              </thead>
              <tbody>
                <?=$myjobs;?>
              </tbody>
            </table>
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="settings">
              <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action' =>['members/update?id='.$model->id], 'method' => 'post']); ?>
              <div class="row">
                <div class="col-xs-3 pull-right">
                  <?= $form->field($model, 'is_freelancer')->widget(\oakcms\bootstrapswitch\Switcher::className());?>
                </div>

              </div>
              <hr>
              <div class="row">
                <div class="col-xs-3">
                   <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-xs-3">
                   <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-xs-3">
                   <?= $form->field($model, 'paypal_email')->textInput(['maxlength' => true]) ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-xs-3">
                   <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-xs-3">
                   <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-xs-3">
                   <?= $form->field($model, 'town')->textInput(['maxlength' => true]) ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-xs-3">
                   <?= $form->field($model, 'occupation')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-xs-3">
                   <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-xs-8">
                   <?= $form->field($model, 'introduction')->widget(\bizley\quill\Quill::className(), []) ?>
                </div>

              </div>
              <div class="row">
                <div class="col-xs-6">
                  <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
              </div>


              <?php ActiveForm::end(); ?>
          </div>
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

<?php $script = <<<EOD
$(document).ready(function() {
    $('#hourliestable').DataTable();
    $('#jobtable').DataTable();
} );
EOD;
$this->registerJs($script);
?>
