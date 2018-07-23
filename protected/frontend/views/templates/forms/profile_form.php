<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\web\JqueryAsset;
use kartik\typeahead\TypeaheadBasic;
use kartik\typeahead\Typeahead;
use kartik\widgets\FileInput;
use app\models\AppsCountries;
use app\models\Cities;
use yii\helpers\Url;

JqueryAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>




    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
		<!--occupation-->
    <?= $form->field($model, 'full_name')->textInput(['maxlength' => 52]); ?>
    <?= $form->field($model, 'occupation')->textInput(['maxlength' => 52]); ?>
    <?= $form->field($model, 'company_name')->textInput(['maxlength' => 52]); ?>

        <!--Cover Photo-->
        <img id="cover" src="<?=Url::base().'/'.$model->cover_photo; ?>" alt="<?=Yii::t('frontend', 'Your Image');?>" height="90" />

        <?php echo $form->field($model, 'imageFile')->widget(FileInput::classname(), [
    'options' => ['id' => 'coverup', 'accept' => 'image/jpeg'],
    'pluginOptions' => [
        'showPreview' => false,
        'showCaption' => false,
        'showRemove' => true,
        'showUpload' => false,
        'browseLabel' => '',
        'removeLabel' => '',
    ],

]); ?>

        <!--Profile Pic-->
		<img id="profilepiuc" src="<?=$model->profile_picture; ?>" alt="<?=Yii::t('frontend', 'Your Image');?>" height="130" width="130" />
         <?php echo $form->field($model, 'file')->widget(FileInput::classname(), [
    'options' => ['showUpload' => false, 'accept' => 'image/*', 'id' => 'profileup'],
    'pluginOptions' => [
        'showPreview' => false,
        'showCaption' => false,
        'showRemove' => true,
        'showUpload' => false,
        'browseLabel' => '',
        'removeLabel' => '',
    ],
]); ?>


        <!--hourlie rate-->

        <?= $form->field($model, 'hourlie_rate')->textInput(['maxlength' => 6, 'class' => 'form-control formhourlieRate']); ?>

        <?= $form->field($model, 'paypal_email')->textInput(); ?>

        <!--Phone number-->
        <?= $form->field($model, 'phone')->textInput(['maxlength' => 22]); ?>

        <!--ABOUT YOU-->
		<?= $form->field($model, 'introduction')->textArea(array('rows' => 10, 'cols' => 10, 'readonly' => false));?>

        <!--YOUR PROFILE SKILLS-->
        <?php $data = [
    'Alabama',
            ];
        ?>
        <?= $form->field($model, 'skills')->widget(Typeahead::classname(), [
    'dataset' => [
        [
            'local' => $data,
            'limit' => 10,
        ],
    ],
    'pluginOptions' => ['highlight' => true],
    'options' => ['placeholder' => Yii::t('frontend', 'Filter as you type..'), 'data-role' => 'tagsinput'],
]); ?>

	<!--Portfolio-->
    <?php
    $preview1 = $model->portfolio;
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
    echo $form->field($model, 'uploadPortfolio[]')->widget(FileInput::classname(), [
    'options' => ['multiple' => true],
    'pluginOptions' => [
    'showUpload' => false,
    'previewSettings' => ['image' => ['width' => '120px', 'height' => '120px']],
    'previewFileType' => 'any',
    'initialPreview' => $ted2,
        'initialPreviewAsData' => true,
        'initialCaption' => Yii::t('frontend', 'My Portfolio'),
        'initialPreviewConfig' => $ted,
        'overwriteInitial' => false,
        'maxFileSize' => 2800,

    ],
]); ?>

	<!--Address Country-->
    <?= $form->field($model, 'country')->widget(TypeaheadBasic::classname(), [
    'data' => ArrayHelper::map(AppsCountries::find()->all(), 'id', 'country_name'),
    'dataset' => ['limit' => 10],
    'options' => ['placeholder' => Yii::t('frontend', 'Filter as you type..')],
    'pluginOptions' => ['highlight' => true],
]); ?>


	<!--Address City Typehead Will be too Server intensive to load all but uncomment to use typehead city-->
<?php /*?>   <?= $form->field($model, 'city')->widget(TypeaheadBasic::classname(), [
    'data' => ArrayHelper::map(Cities::find()->all(),'id','name'),
    'dataset' => ['limit' => 10],
    'options' => ['placeholder' => 'Filter as you type ...'],
    'pluginOptions' => ['highlight'=>true],
]); ?><?php */?>
	<!--Address city Manual-->
    <?= $form->field($model, 'city')->textInput(['maxlength' => 52]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
