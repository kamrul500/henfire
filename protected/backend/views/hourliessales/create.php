<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\hourliessales */

$this->title = Yii::t('backend', 'Create Hourlies sales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Hourliessales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hourliessales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
