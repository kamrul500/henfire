<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Hourlieworkstream */

$this->title = Yii::t('frontend', 'Create Hourlieworkstream');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Hourlieworkstreams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hourlieworkstream-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
