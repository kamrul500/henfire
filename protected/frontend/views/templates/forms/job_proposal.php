<?php

use yii\helpers\Html;
use app\models\JobProposals;
use kartik\form\ActiveForm;
use common\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\JobProposals */
/* @var $form yii\widgets\ActiveForm */
$user_id = Yii::$app->user->identity->id;
$countrycode = Yii::$app->user->identity->country_code;
$mycurrency = MyHelpers::Currency();
$JobProposals = new JobProposals();
?>

<div class="job-proposals-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
          $form->action = yii\helpers\Url::to('../job-proposals\create'); ?>

      <?= $form->field($JobProposals, 'user_id')->hiddenInput(['value' => $user_id])->label(false); ?>
      <?= $form->field($JobProposals, 'job_id')->hiddenInput(['value' => $model->id])->label(false); ?>

      <div class="col-md-6">
          <?= $form->field($JobProposals, 'price', ['addon' => ['prepend' => ['content' => Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency), 'options' => ['class' => 'alert-success']]]]); ?>
      </div>
      <div class="col-md-6">
          <?php $days = ['1' => Yii::t('frontend','1 day'), '2' => Yii::t('frontend','2 days'), '3' => Yii::t('frontend','3 days'), '4' => Yii::t('frontend','4 days'), '5' => Yii::t('frontend','5 days'),
           '6' => Yii::t('frontend','6 days'), '7' => Yii::t('frontend','7+ days')];
           echo $form->field($JobProposals, 'delivery_time')->dropDownList($days, ['class' => 'form-control']); ?>
      </div>

    <?= $form->field($JobProposals, 'comment')->widget(\bizley\quill\Quill::className(), []) ?>

    <div class="form-group">
        <?= Html::submitButton($JobProposals->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Update'), ['class' => $JobProposals->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
