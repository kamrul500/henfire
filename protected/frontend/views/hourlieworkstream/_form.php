<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Hourlieworkstream */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hourlieworkstream-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'job_id')->textInput() ?>

    <?= $form->field($model, 'freelancer_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'is_finished')->textInput() ?>

    <?= $form->field($model, 'admin_flagged')->textInput() ?>

    <?= $form->field($model, 'freelancer_flagged')->textInput() ?>

    <?= $form->field($model, 'member_flagged')->textInput() ?>

    <?= $form->field($model, 'flagged_comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
