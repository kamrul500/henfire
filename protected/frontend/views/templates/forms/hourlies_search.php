<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\HourliesSearch */
/* @var $form yii\widgets\ActiveForm */
$base_url = preg_replace('/hourlies/', '', basename($_SERVER['REQUEST_URI']))
?>

  <?php $form = ActiveForm::begin([
      'id' => 'suburl',
      'action' => [$base_url],
      'method' => 'get',
  ]); ?>
    <?= $form->field($model, 'title', [
    'addon' => [
        'append' => [
            'content' => Html::submitButton('<span class="glyphicon glyphicon-search"></span>', ['class'=>'btn btn-primary']),
            'asButton' => true
        ]
    ]
])->textInput(['placeholder'=>Yii::t('frontend','Search Hourlies')])->label(false); ?>
    <?php ActiveForm::end(); ?>
