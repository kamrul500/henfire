<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Hourlieworkflow */

$this->title = Yii::t('app', 'Create Hourlieworkflow');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hourlieworkflows'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hourlieworkflow-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
