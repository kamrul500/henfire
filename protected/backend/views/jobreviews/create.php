<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Jobreviews */

$this->title = Yii::t('backend', 'Create Jobreviews');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Jobreviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobreviews-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
