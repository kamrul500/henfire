<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HourlieworkflowSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hourlieworkflow-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'workstream') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'comment') ?>

    <?= $form->field($model, 'upload') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'flagged') ?>

    <?php // echo $form->field($model, 'flagged_comment') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
