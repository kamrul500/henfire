<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use common\components\MyHelpers;


/* @var $this yii\web\View */
/* @var $model app\models\Hourliesreviews */

$this->title = Yii::t('backend', 'Update Review');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Hourliesreviews'), 'url' => ['/hourliesreviews']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hourliesreviews-create">
  <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
  <section class="content">
       <!-- Info boxes -->
     <div class="row">
       <div class="col-md-6">
         <div class="box box-primary">
               <div class="box-body">
                 <div class="row">
                   <div class="col-xs-6">
                     <?php  $catList = ArrayHelper::map(app\models\User::find('username','id')->where(['is_freelancer' => 0])->orderBy('username')->all(), 'id', 'username');?>
                     <?= $form->field($model, 'user_id')->dropDownList($catList, ['prompt' => '---- '.Yii::t('backend','Select User').' ----', 'id' => 'Customers']);?>
                   </div>
                   <div class="col-xs-6">
                     <?php  $catList = ArrayHelper::map(app\models\User::find('username','id')->where(['is_freelancer' => 1])->orderBy('username')->all(), 'id', 'username');?>
                     <?= $form->field($model, 'freelancer_id')->dropDownList($catList, ['prompt' => '---- '.Yii::t('backend','Freelancer').' ----', 'id' => 'Customers']);?>
                   </div>
                   <div class="col-xs-4">
                     <?= $form->field($model, 'hourlie_id')->textInput(['maxlength' => true]) ?>
                   </div>
                   <div class="col-xs-4">
                     <?php $rating = ['1' => Yii::t('backend','1'), '2' => Yii::t('backend','2'), '3' => Yii::t('backend','3'),
                     '4' => Yii::t('backend','4'), '5' => Yii::t('backend','5')]; ?>
                      <?= $form->field($model, 'rating')->dropDownList($rating, ['class' => 'form-control']); ?>
                   </div>

                   <div class="col-xs-12">
                     <?= $form->field($model, 'review')->widget(\bizley\quill\Quill::className(), []) ?>
                   </div>
                   <div class="col-xs-12">
                     <?= $form->field($model, 'replies')->widget(\bizley\quill\Quill::className(), []) ?>
                   </div>
                   <div class="col-xs-6">
                     <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                   </div>
                 </div>
               </div>
          </div>
        </div>
     </div>
   </section>

  <?php ActiveForm::end(); ?>
</div>
