<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\HourliesReviewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hourlies-reviews-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'hourlie_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'freelancer_id') ?>

    <?= $form->field($model, 'rating') ?>

    <?php // echo $form->field($model, 'review')?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend','Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('frontend','Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
