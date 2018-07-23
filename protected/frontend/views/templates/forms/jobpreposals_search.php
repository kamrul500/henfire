<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JobProposalsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-proposals-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'job_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'delivery_time') ?>

    <?php // echo $form->field($model, 'comment')?>

    <?php // echo $form->field($model, 'accepted')?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('frontend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
