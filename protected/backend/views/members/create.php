<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use kartik\widgets\FileInput;
use common\components\MyHelpers;


/* @var $this yii\web\View */
/* @var $model app\models\Hourlies */

$this->title = Yii::t('backend', 'Create Hourlies');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Hourlies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$preview1 = $model->images;
if (!empty($preview1)) {
    $preview = json_decode($preview1);
    $data = [];

    foreach ($preview as $value) {
        //Make a multidimensional array
  $imagename = basename($value);
        $data[] = ['caption' => $imagename, 'size' => '873727'];
    }
    $ted = ArrayHelper::toArray($data);
    $ted2 = ArrayHelper::toArray($preview);
} else {
    $ted = '';
    $ted2 = '';
}
?>
<div class="hourlies-create">
  <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
  <section class="content">
       <!-- Info boxes -->
     <div class="row">
       <div class="col-md-6">
         <div class="box box-primary">
               <div class="box-body">
                 <div class="row">
                   <div class="col-xs-12">
                     <?php  $catList = ArrayHelper::map(app\models\User::find('username','id')->where(['is_freelancer' => 1])->orderBy('username')->all(), 'id', 'username');?>
                   <?= $form->field($model, 'user_id')->dropDownList($catList, ['prompt' => '---- '.Yii::t('backend','Select Freelancer').' ----', 'id' => 'Customers']);?>

                   </div>
                   <div class="col-xs-12">
                       <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                   </div>
                   <div class="col-xs-12">
                      <?= $form->field($model, 'description')->widget(\bizley\quill\Quill::className(), []) ?>
                   </div>
                   <div class="col-xs-12">
                      <?= $form->field($model, 'needed')->widget(\bizley\quill\Quill::className(), []) ?>
                   </div>
                   <div class="col-xs-6">
                     <?php  $catList = ArrayHelper::map(app\models\JobCategory::find()->orderBy('Category')->all(), 'Category', 'Category');?>
                   <?= $form->field($model, 'category')->dropDownList($catList, ['prompt' => '---- '.Yii::t('frontend','Select Category').' ----', 'id' => 'mycat']);?>
                   </div>
                   <div class="col-xs-6">
                     <?=
                            $form->field($model, 'subCat')->widget(DepDrop::classname(), [
                               'options' => ['id' => 'subcategory'],
                               'data' => [0 => $model->subCat],
                               'type' => DepDrop::TYPE_SELECT2,
                               'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                               'pluginOptions' => [
                               'depends' => ['mycat'], // the id for cat attribute
                               'placeholder' => Yii::t('backend','Select...'),
                               'url' => \yii\helpers\Url::to(['subcat']),
                               ],
                               ]);
                           ?>
                   </div>
                   <div class="col-xs-12">
                      <?= $form->field($model, 'video')->textInput(['maxlength' => true]); ?>
                   </div>
                   <div class="col-xs-12">
                     <label class="control-label">Images</label>
                     <br />
                     <?= $form->field($model, 'image[]')->widget(FileInput::classname(), [
                        'options' => ['multiple' => true, 'accept' => 'image/*'],
                        'pluginOptions' => [
                        'showUpload' => false,
                        'previewSettings' => ['image' => ['width' => '120px', 'height' => '120px']],
                        'previewFileType' => 'any',
                        'initialPreview' => $ted2,
                            'initialPreviewAsData' => true,
                            'initialCaption' => Yii::t('frontend','My Portfolio'),
                            'initialPreviewConfig' => $ted,
                            'overwriteInitial' => false,
                            'maxFileSize' => 2800,

                        ],
                    ]); ?>
                     <br />
                   </div>
                   <div class="col-xs-6">
                     <?php $days = ['1' => Yii::t('frontend','1 day'), '2' => Yii::t('frontend','2 days'), '3' => Yii::t('frontend','3 days'),
                     '4' => Yii::t('frontend','4 days'), '5' => Yii::t('frontend','5+ days')]; ?>
                      <?= $form->field($model, 'delivery_time')->dropDownList($days, ['class' => 'form-control']); ?>
                   </div>
                   <div class="col-xs-6">
                     <?= $form->field($model, 'cost', ['addon' => ['prepend' => ['content' => Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()), 'options' => ['class' => 'alert-success']]]]); ?>
                   </div>

                 </div>
                 <!-- /.End ROW -->
               </div>
               <!-- /.box-body -->
             </div>
          </div>

        <div class="col-md-6">
          <div class="box box-warning">
                <div class="box-body">
                  <div class="row">
                    <div class="col-xs-6">
                      <?=$form->field($model, 'promoted')->checkbox();?>
                    </div>
                    <div class="col-xs-6">
                      <?=$form->field($model, 'dissabled')->checkbox();?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="box box-success">
                    <div class="box-body">
                      <div class="row">
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
