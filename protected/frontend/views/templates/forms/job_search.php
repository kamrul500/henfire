<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JobSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'subCat')?>

    <?php // echo $form->field($model, 'date_created')?>

    <?php // echo $form->field($model, 'date_expire')?>

    <?php // echo $form->field($model, 'cost')?>

    <?php // echo $form->field($model, 'material')?>

    <?php // echo $form->field($model, 'promoted')?>

    <?php // echo $form->field($model, 'paid')?>

    <?php // echo $form->field($model, 'success')?>

    <?php // echo $form->field($model, 'worktype')?>

    <?php // echo $form->field($model, 'currency')?>

    <?php // echo $form->field($model, 'budget')?>

    <?php // echo $form->field($model, 'experience_level')?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('frontend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
