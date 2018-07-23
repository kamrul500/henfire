<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JobQuestionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-questions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'job_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'question') ?>

    <?= $form->field($model, 'answer') ?>

    <?php // echo $form->field($model, 'request_date') ?>

    <?php // echo $form->field($model, 'answer_date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
