<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;
use kartik\widgets\DepDrop;
use yii\helpers\Json;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Job */
/* @var $form yii\widgets\ActiveForm */

$user_id = Yii::$app->user->identity->id;
if (Yii::$app->user->isGuest) {
    $mycurrency = MyHelpers::Currency();
} else {
    $mycurrency = Yii::$app->user->identity->currency;
}
$countrycode = Yii::$app->user->identity->country_code;

$entryLevel = Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency);
$intermediatelevel = Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency).''.Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency);
$advancedlevel = Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency).''.Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency).''.Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency);
?>

<div class="job-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<?php /*?>
<?= $form->field($model, 'user_id')->textInput() ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'subCat')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'date_created')->textInput() ?>
    <?= $form->field($model, 'date_expire')->textInput() ?>
    <?= $form->field($model, 'material')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'promoted')->textInput() ?>
    <?= $form->field($model, 'paid')->textInput() ?>
    <?= $form->field($model, 'success')->textInput() ?>
    <?= $form->field($model, 'worktype')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'budget')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'experience_level')->textInput() ?><?php */?>
 <!--Job Title-->
 <?= $form->field($model, 'user_id')->hiddenInput(['value' => $user_id])->label(false); ?>
 <?= $form->field($model, 'title')->textInput(['maxlength' => 100]) ?>
	<!--Select Box 1-->
    <div class="col-md-6">
    <?php  $catList = ArrayHelper::map(app\models\JobCategory::find()->orderBy('Category')->all(), 'Category', 'Category');
  echo $form->field($model, 'category')->dropDownList($catList, ['prompt' => '---- '.Yii::t('frontend','Category Select').' ----', 'id' => 'mycat']);
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
            'placeholder' => Yii::t('frontend','Select'),
            'url' => \yii\helpers\Url::to(['job/subcat']),
            ],
            ]);
        ?>
   </div>



    <!--Job Description-->
	 <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic',
    ]) ?>

    <!--Material Upload-->
    <?php
    $preview1 = $model->material;
    if (!empty($preview1)) {
        $preview = json::decode($preview1);
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
    echo $form->field($model, 'mymaterial[]')->widget(FileInput::classname(), [
    'options' => ['multiple' => true],
    'pluginOptions' => [
    //'uploadUrl' => Url::to(['job/files']),
    'showUpload' => false,
    'previewSettings' => ['image' => ['width' => '120px', 'height' => '120px']],
    'previewFileType' => 'any',
    'initialPreview' => $ted2,
        'initialPreviewAsData' => true,
        'initialCaption' => Yii::t('frontend','My Material'),
        'initialPreviewConfig' => $ted,
        'overwriteInitial' => false,
        'maxFileSize' => 2800,

    ],
]); ?>



	<!--Dates-->


    <div class="col-md-4">
        <?php $days = ['hour' => Yii::t('frontend','Per Hour'), 'fixed' => Yii::t('frontend','Fixed Price')];
         echo $form->field($model, 'worktype')->dropDownList($days, ['class' => 'form-control']); ?>
    </div>

    <div class="col-md-4">
        <?= $form->field($model, 'budget', ['addon' => ['prepend' => ['content' => Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency), 'options' => ['class' => 'alert-success']]]]); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'date_expire')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => Yii::t('frontend','Enter expire date')],
    'removeButton' => false,
    'pluginOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',

    ],
]); ?>
    </div>
    <div class="col-md-12 text-center">
      <div class="col-md-4 radclick1">
    <?= $form->field($model, 'experience_level', ['template' => "<div class=\"radio1\">\n{input}\n<label class=\"control-label\" for=\"radio1\"><div class=\"divasradio1\"><div class=\"radiotitle1 text-center\">".Yii::t('frontend','ENTRY LEVEL')."</div><div class=\"radiotext text-center\">".Yii::t('frontend','Basic work at a low rate per hour')."</div><div class=\"levelcurrency\">$entryLevel</div></div></label>\n{error}\n{hint}\n</div>"])->input('radio', ['value' => 1, 'id' => 'radio1', 'uncheck' => null])?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'experience_level', ['template' => "<div class=\"radio2\">\n{input}\n<label class=\"control-label\" for=\"radio2\"><div class=\"divasradio2\"><div class=\"radiotitle2 text-center\">".Yii::t('frontend','INTERMEDIATE')."</div><div class=\"radiotext text-center\">".Yii::t('frontend','Moderate knowledge at a middle rate per hour')."</div><div class=\"levelcurrency\">$intermediatelevel</div></div></label>\n{error}\n{hint}\n</div>"])->input('radio', ['value' => 2, 'id' => 'radio2', 'uncheck' => null])?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'experience_level', ['template' => "<div class=\"radio3\">\n{input}\n<label class=\"control-label\" for=\"radio3\"><div class=\"divasradio3\"><div class=\"radiotitle3 text-center\">".Yii::t('frontend','EXPERT')."</div><div class=\"radiotext text-center\">".Yii::t('frontend','Expert level freelancers at a higher rate per hour')."</div><div class=\"levelcurrency\">$advancedlevel</div></div></label>\n{error}\n{hint}\n</div>"])->input('radio', ['value' => 3, 'id' => 'radio3', 'uncheck' => null])?>
    </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< 'JS'

   $(document).ready(function() {

    $( ".radio1" ).click(function() {
      $(".divasradio1").addClass('radiochecked');
      $(".divasradio2").removeClass('radiochecked');
      $(".divasradio3").removeClass('radiochecked');
    });
    $( ".radio2" ).click(function() {
      $(".divasradio1").removeClass('radiochecked');
      $(".divasradio2").addClass('radiochecked');
      $(".divasradio3").removeClass('radiochecked');
    });
    $( ".radio3" ).click(function() {
      $(".divasradio1").removeClass('radiochecked');
      $(".divasradio2").removeClass('radiochecked');
      $(".divasradio3").addClass('radiochecked');
    });
});

JS;
$this->registerJs($script);
?>
