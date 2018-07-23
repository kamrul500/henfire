<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\HourlieworkstreamSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hourlieworkstream-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'job_id') ?>

    <?= $form->field($model, 'freelancer_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'is_finished') ?>

    <?= $form->field($model, 'admin_flagged') ?>

    <?php // echo $form->field($model, 'freelancer_flagged') ?>

    <?php // echo $form->field($model, 'member_flagged') ?>

    <?php // echo $form->field($model, 'flagged_comment') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('frontend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
