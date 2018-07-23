<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
?>
  <?php $form = ActiveForm::begin([
      'id' => 'suburl-index',
      'action' => ['/hourlies/?'],
      'method' => 'get',
      'type' => ActiveForm::TYPE_VERTICAL,
  ]); ?>
    <?= $form->field($model, 'title', [
    'addon' => [
        'append' => [
            'content' => Html::submitButton(Yii::t('frontend','Search Hourlies'), ['class'=>'btn btn-primary hourliessearch']),
            'asButton' => true
        ]
    ]
])->textInput(['placeholder'=>Yii::t('frontend','Search Hourlies')])->label(false); ?>
    <?php ActiveForm::end(); ?>
