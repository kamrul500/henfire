<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;

$this->title = 'Signup';
?>


<div class="container">
    <div class="signup-view">
        <h1><?= Html::encode($this->title) ?></h1>


                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                   <?= $form->field($model, 'is_freelancer')->checkbox(array('label'=>'I am a freelancer', 'value' => '1', 'class' => 'freelancerbox'));?>
                  
                   <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>


    </div>
</div>
