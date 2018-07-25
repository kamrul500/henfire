<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FreelancerSearch */
/* @var $form yii\widgets\ActiveForm */
?>


    <?php $form = ActiveForm::begin([
        'id' => 'suburl',
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'title', [
    'addon' => [
        'append' => [
          'content' => Html::submitButton('<span class="glyphicon glyphicon-search"></span>', ['class'=>'btn btn-primary']),
          'asButton' => true
        ]
    ]
])->textInput(['placeholder'=>Yii::t('frontend','Search Jobs')])->label(false); ?>
    <?php ActiveForm::end(); ?>
