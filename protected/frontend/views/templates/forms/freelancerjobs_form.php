<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Job */
/* @var $form yii\widgets\ActiveForm */
$user_id = Yii::$app->user->identity->id;
?>

<div class="job-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'user_id')->hiddenInput(['value' => $user_id])->label(false); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic',
    ]) ?>

    <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'date_created')->hiddenInput(['value' => date('Y-m-d H:m:s')])->label(false); ?>

    <?= $form->field($model, 'date_expire')->widget(\yii\jui\DatePicker::classname(), [
    //'language' => 'ru',
   'dateFormat' => 'yyyy-MM-dd',
]) ?>

   	<?php $cats = ArrayHelper::map(\app\models\Categories::find()->orderBy('cat_name')->all(), 'id', 'cat_name') ?>
	<?= $form->field($model, 'category_id')->dropDownList($cats, ['prompt' => '---- '.Yii::t('frontend','Select Category').' ----'])->label('Category') ?>

  

    <?php /*?><?= $form->field($model, 'promoted')->textInput() ?>

    <?= $form->field($model, 'paid')->textInput() ?>

    <?= $form->field($model, 'success')->textInput() ?><?php */?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
