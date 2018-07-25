<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JobCategory */

$this->title = Yii::t('backend', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Job Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-category-create">
  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= Yii::t('backend', 'Enter main category and also sub category');?></h3>
        </div>
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
