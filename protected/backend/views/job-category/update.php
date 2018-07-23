<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JobCategory */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Job Category',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Job Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="job-category-update">
  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-body">
          <?= $this->render('_form', [
              'model' => $model,
          ]) ?>
        </div>
        <!-- /.box-body -->
     </div>
   </div>
 </div>
</div>
