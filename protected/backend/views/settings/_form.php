<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\web\JqueryAsset;
use kartik\typeahead\TypeaheadBasic;
use kartik\typeahead\Typeahead;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use common\components\MyHelpers;
use app\models\AppsCountries;
use yii\helpers\Json;


JqueryAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

  <section class="content">
       <!-- Info boxes -->
     <div class="row">
       <div class="col-md-6">
         <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
          <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title"><?= Yii::t('backend', 'Website Logo');?></h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-xs-3">
                      <?php echo $form->field($model, 'logonew')->widget(FileInput::classname(), [
                 'options' => ['showUpload' => false, 'accept' => 'image/*', 'id' => 'logoset'],
                 'pluginOptions' => [
                     'showPreview' => false,
                     'showCaption' => false,
                     'showRemove' => true,
                     'showUpload' => false,
                     'browseLabel' => '',
                     'removeLabel' => '',
                 ],
             ])->label(false); ?>
                    </div>
                    <div class="col-xs-9">
                    <img id="logodem" src="<?=MyHelpers::WebsiteLogo(); ?>" alt="Website Logo" height="39px"/>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
           </div>
         <!-- /.box -->
         <div class="box box-primary">
               <div class="box-header with-border">
                 <h3 class="box-title"><?= Yii::t('backend', 'Website Information');?></h3>
               </div>
               <div class="box-body">
                 <div class="row">
                   <div class="col-xs-6">
                       <?= $form->field($model, 'sitename')->textInput(['maxlength' => true]) ?>
                   </div>
                   <div class="col-xs-6">
                     <?= $form->field($model, 'site_seo_title')->textInput(['maxlength' => true]) ?>
                   </div>
                 </div>
                 <!-- /.End ROW -->
                 <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

                 <div class="row">
                   <div class="col-xs-6">
                      <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                   </div>
                   <div class="col-xs-6">
                     <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>
                   </div>

                 </div>
               </div>
               <!-- /.box-body -->
          </div>
        <!-- /.box -->
        <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?= Yii::t('backend', 'Social');?></h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-6">
                     <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>
                  </div>
                  <div class="col-xs-6">
                    <?= $form->field($model, 'twitter')->textInput(['maxlength' => false]) ?>
                  </div>
                  <div class="col-xs-6">
                    <?= $form->field($model, 'google')->textInput(['maxlength' => false]) ?>
                  </div>
                </div>
                <!-- /.End ROW -->

              </div>
              <!-- /.box-body -->
         </div>
       <!-- /.box -->
       <div class="box box-solid">
             <div class="box-header with-border">
               <h3 class="box-title"><?= Yii::t('backend', 'Update Settings');?></h3>
             </div>
             <div class="box-body">
               <div class="form-group">
                   <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
               </div>
             </div>
             <!-- /.box-body -->
        </div>
      <!-- /.box -->
       <?php
      $selectedc = AppsCountries::find()->where(['display'=>'1'])->all();
      $array = array();
                   foreach ($selectedc as $key) {

                           $array[] .= $key['id'];
                   }
           $selectedcountry = $array;
    ?>

      </div>
      <div class="col-md-6">
        <div class="box box-warning">
              <div class="box-header with-border">
                <h3 class="box-title"><?= Yii::t('backend', 'Site Settings');?></h3>
              </div>
              <div class="box-body">

                <label class="control-label"><?= Yii::t('backend', 'Countries to display');?></label>
              <?= Select2::widget([
                'name' => 'Countries',
                'value' => $selectedcountry, // initial value
                'data' => ArrayHelper::map(AppsCountries::find()->all(), 'id', 'country_name'),
                'maintainOrder' => true,
                'toggleAllSettings' => [
                    'selectLabel' => '<i class="glyphicon glyphicon-ok-circle"></i> Tag All',
                    'unselectLabel' => '<i class="glyphicon glyphicon-remove-circle"></i> Untag All',
                    'selectOptions' => ['class' => 'text-success'],
                    'unselectOptions' => ['class' => 'text-danger'],
                ],
                'options' => ['placeholder' => 'Select Listed countries ...', 'multiple' => true],
                'pluginOptions' => [
                    'tags' => true,
                    'maximumInputLength' => 100
                ],
            ]);?>
             <p class="margin"></p>
                <div class="row">

                  <div class="col-xs-6">
                    <?= $form->field($model, 'commission')->textInput(['maxlength' => true]) ?>
                  </div>
                  <div class="col-xs-6">
                    <p class="margin"><?= Yii::t('backend', 'The commission that you will charge for website services');?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-6">
                    <?= $form->field($model, 'feature_hourlie_price')->textInput(['maxlength' => true]) ?>
                  </div>
                  <div class="col-xs-6">
                    <p class="margin"><?= Yii::t('backend', 'The cost to feature an hourlie per week');?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-6">
                    <?= $form->field($model, 'feature_job_price')->textInput(['maxlength' => true]) ?>
                  </div>
                  <div class="col-xs-6">
                    <p class="margin"><?= Yii::t('backend', 'The cost to feature a job per week ');?></p>
                  </div>
                </div>
                <!-- /.End ROW -->

              </div>
              <!-- /.box-body -->
         </div>
       <!-- /.box -->
       <div class="box box-info">
             <div class="box-header with-border">
               <h3 class="box-title"><?= Yii::t('backend', 'PayPal Settings');?></h3>
             </div>
             <div class="box-body">
               <div class="row">
                 <div class="col-xs-12">
                    <?= $form->field($model, 'PayPalAuth')->textInput(['maxlength' => true]) ?>
                 </div>
                 <div class="col-xs-12">
                   <?= $form->field($model, 'PayPalSecret')->textInput(['maxlength' => true]) ?>
                 </div>
                 <div class="col-xs-6">
                   <?= $form->field($model, 'PayPalEnvironment')->textInput(['maxlength' => true]) ?>
                 </div>
                 <div class="col-xs-6">
                 <p class="margin"><?= Yii::t('backend', 'Live or Sandbox');?></p>
                 </div>
               </div>
               <!-- /.End ROW -->

             </div>
             <!-- /.box-body -->
        </div>
      <!-- /.box -->

      </div>
    </div>
    </section>

    <?php ActiveForm::end(); ?>
