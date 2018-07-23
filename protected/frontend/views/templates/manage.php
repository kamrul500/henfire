<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Activity'; ?>
<div class="container">
      <div class="row">
        <section class="col-lg-4 connectedSortable ui-sortable">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black" style="background: url('<?=Yii::$app->user->identity->cover_photo;?>') center center; background-size: cover;">
              <h3 class="widget-user-username <?= $textcolour; ?>"><?=Yii::$app->user->identity->username;?></h3>
              <h5 class="widget-user-desc <?= $textcolour; ?>"><?=Yii::$app->user->identity->occupation;?></h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="<?=Yii::$app->user->identity->profile_picture;?>" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-6 border-right">
                  <div class="description-block">
                    <h2 class="description-header2"><?=$sumopenjobs;?></h2>
                    <span class="description-text"><?= Yii::t('frontend', 'CURRENT OPEN JOBS');?></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6 border-right">
                  <div class="description-block">
                    <h2 class="description-header2"><?= $sumostreams;?></h2>
                    <span class="description-text"><?= Yii::t('frontend', 'OPEN HOURLIES');?></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
      </section>
      <section class="col-lg-8 connectedSortable ui-sortable">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">

              <li class="active"><a href="#tab_2-2" data-toggle="tab"><?=Yii::t('frontend','Hourlies');?></a></li>
              <li><a href="#tab_3-2" data-toggle="tab"><?=Yii::t('frontend','My Jobs');?></a></li>

              <li class="pull-left header"><i class="fa fa-th"></i> <?=Yii::t('frontend','Activity');?></li>
            </ul>
            <div class="tab-content">

              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tab_2-2">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=Yii::t('frontend', 'Hourlies Purchased')?></h3>

                  <p><?=Yii::t('frontend', 'A list of all your hourlies')?></p>
                </div>
                <table id="hourlies" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th><?=Yii::t('backend', 'Name');?></th>
                    <th><?=Yii::t('backend', 'Price');?></th>
                    <th><?=Yii::t('backend', 'Date');?></th>
                    <th><?=Yii::t('backend', 'Payment Status');?></th>
                    <th><?=Yii::t('backend', 'Workflow');?></th>
                  </tr>
                  </thead>
                  <tbody>
                    <?=$HourliesTable;?>
                  </tbody>
                </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3-2">
                <div class="box-header with-border">
              <h3 class="box-title"><?=Yii::t('frontend', 'My Jobs')?></h3>

              <p><?=Yii::t('frontend', 'Manage your current Jobs')?></p>
            </div>
                <table id="jobs" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th><?=Yii::t('backend', 'Title');?></th>
                    <th><?=Yii::t('backend', 'Status');?></th>
                    <th><?=Yii::t('backend', 'Budget');?></th>
                    <th><?=Yii::t('backend', 'Actions');?></th>

                  </tr>
                  </thead>
                  <tbody>
                    <?=$jobsTable;?>
                  </tbody>
                </table>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
      </section>
</div>
<?php $script = <<<EOD
$(document).ready(function() {
    
} );
EOD;
$this->registerJs($script);
?>
