<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Userreviews */

$this->title = Yii::t('frontend', 'Create Userreviews');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Userreviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userreviews-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
