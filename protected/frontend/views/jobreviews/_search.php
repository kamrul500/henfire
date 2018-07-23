<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JobreviewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jobreviews-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'job_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'freelancer_id') ?>

    <?= $form->field($model, 'rating') ?>

    <?php // echo $form->field($model, 'review') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'replies') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('frontend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
