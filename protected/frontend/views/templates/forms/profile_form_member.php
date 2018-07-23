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
        <img id="cover" src="<?=$model->cover_photo; ?>" alt="<?=Yii::t('frontend', 'Your Image');?>" height="90" />

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



        <!--Phone number-->
        <?= $form->field($model, 'phone')->textInput(['maxlength' => 22]); ?>

        <!--ABOUT YOU-->
		<?= $form->field($model, 'introduction')->textArea(array('rows' => 10, 'cols' => 10, 'readonly' => false));?>

	<!--Address Country-->
    <?= $form->field($model, 'country')->widget(TypeaheadBasic::classname(), [
    'data' => ArrayHelper::map(AppsCountries::find()->all(), 'id', 'country_name'),
    'dataset' => ['limit' => 10],
    'options' => ['placeholder' => Yii::t('frontend', 'Filter as your type')],
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
