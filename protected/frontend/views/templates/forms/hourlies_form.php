<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use common\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Hourlies */
/* @var $form yii\widgets\ActiveForm */

$user_id = Yii::$app->user->identity->id;
$mycurrency = MyHelpers::Currency();
$countrycode = Yii::$app->user->identity->country_code;
?>

<div class="hourlies-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value' => $user_id])->label(false); ?>
    <?= $form->field($model, 'currency_code')->hiddenInput(['value' => $mycurrency])->label(false); ?>
    <?= $form->field($model, 'country_code')->hiddenInput(['value' => $countrycode])->label(false); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => 100, 'placeholder' => Yii::t('frontend','I can..')]) ?>
<div class="col-md-6">
    <?= $form->field($model, 'cost', ['addon' => ['prepend' => ['content' => Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency), 'options' => ['class' => 'alert-success']]]]); ?>
</div>
<div class="col-md-6">
    <?php $days = ['1' => Yii::t('frontend','1 day'), '2' => Yii::t('frontend','2 days'), '3' => Yii::t('frontend','3 days'),
    '4' => Yii::t('frontend','4 days'), '5' => Yii::t('frontend','5+ days')]; ?>
     <?= $form->field($model, 'delivery_time')->dropDownList($days, ['class' => 'form-control']); ?>
</div>
    <div class="col-md-6">
    <?php  $catList = ArrayHelper::map(app\models\JobCategory::find()->orderBy('Category')->all(), 'Category', 'Category');
  echo $form->field($model, 'category')->dropDownList($catList, ['prompt' => '---- '.Yii::t('frontend','Select Category').' ----', 'id' => 'mycat']);
  ?>
  </div>
  <!--Select Box 2-->

   <div class="col-md-6">
  <?=
         $form->field($model, 'subCat')->widget(DepDrop::classname(), [
            'options' => ['id' => 'subcategory'],
            'data' => [0 => $model->subCat],
            'type' => DepDrop::TYPE_SELECT2,
            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
            'pluginOptions' => [
            'depends' => ['mycat'], // the id for cat attribute
            'placeholder' => Yii::t('frontend','Select...'),
            'url' => \yii\helpers\Url::to(['job/subcat']),
            ],
            ]);
        ?>
   </div>


    <?= $form->field($model, 'video')->textInput(['maxlength' => true, 'placeholder' => 'https://www.youtube.com/watch?v=vlDzYIIOYmM']) ?>

    <?= $form->field($model, 'date_created')->hiddenInput(['value' => date('Y-m-d H:m:s')])->label(false); ?>

     <?= $form->field($model, 'description')->widget(\bizley\quill\Quill::className(), []) ?>
<?php
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
    // Usage with ActiveForm and model
    //change here: need to add image_path attribute from another table and add square bracket after image_path[] for multiple file upload.
     echo $form->field($model, 'image[]')->widget(FileInput::classname(), [
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

     <?= $form->field($model, 'needed')->widget(\bizley\quill\Quill::className(), []) ?>
    <div class="form-group">
       <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
