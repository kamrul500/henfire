<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Invite */

$this->title = Yii::t('frontend', 'Freelancer Invite');
$user2 = Yii::$app->user->identity->id;

?>
<div class="container invite-create">

    <h1><?=Yii::t('frontend', 'Invite') .' '. MyHelpers::IdToFullName($freelancer)?></h1>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'job_id')->dropDownList(
        MyHelpers::MyJobsSelect($user),
        ['prompt'=>'Select...']
      );?>

    <?= $form->field($model, 'user')->hiddenInput(['value'=> $user])->label(false); ?>

    <?= $form->field($model, 'frelancer')->hiddenInput(['value'=> $freelancer])->label(false); ?>


    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Invite') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
