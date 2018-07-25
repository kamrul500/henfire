<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use common\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\JobProposals */

$this->title = Yii::t('frontend','Job Proposal');
?>
<div class="container web-view">
    <div class="profile_heading">
        <h2><strong><span class="fa fa-fw"></span><?=Yii::t('frontend', 'Job Proposal');?></strong></h2>
    </div>
    <div class="col-md-12">
      <div class="col-md-12 jobliststyle">
        <div class="pic col-md-2">
        	<?= Html::img(MyHelpers::IdtoPic($model->user_id), ['class' => 'freelance_profile_picture']); ?>
        </div>
        <div class="col-md-8">
        	<h4><?= MyHelpers::IdToName($model->user_id) .' '. $model->date; ?></h4>
          <p><?= $model->comment?></p>
        </div>
        <div class="col-md-2 text-center" style="background: #ccc; padding: 7px;">
          <h2><?=Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()) .' '. $model->price;?></h2>
          <div class="text-center">
          	<div class="cnt_button"><?= Html::a(Yii::t('frontend', 'Accept'), ['job-proposals/accept?id='.$model->id], ['class' => 'btn btn-success']) ?></div>
          </div>
        </div>
      </div>
        <div class="clearfix"></div>
        <div class="profile_heading">
            <h2><strong><span class="fa fa-fw"></span><?=Yii::t('frontend', 'Comments');?></strong></h2>
        </div>
        <?= $questionlist?>

        <div class="comment">
        	<?php $form = ActiveForm::begin(['action' => ['job-proposals/view?id='.$model->id],'options' => ['method' => 'post', 'enctype' => 'multipart/form-data']]) ?>
            <?= $form->field($postcomment, 'upload')->fileInput() ?>
            <?= $form->field($postcomment, 'question')->textarea(['rows' => '6']) ?>
            <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
