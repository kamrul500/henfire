<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HourliesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hourlies-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>


    <?php // echo $form->field($model, 'video') ?>

    <?php // echo $form->field($model, 'video_image') ?>

    <?php // echo $form->field($model, 'images') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'date_expire') ?>

    <?php // echo $form->field($model, 'delivery_time') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'promoted') ?>

    <?php // echo $form->field($model, 'paid') ?>

    <?php // echo $form->field($model, 'success') ?>

    <?php // echo $form->field($model, 'views') ?>

    <?php // echo $form->field($model, 'sales') ?>

    <?php // echo $form->field($model, 'country_code') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
