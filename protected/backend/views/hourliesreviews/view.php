<?php

use yii\helpers\Html;
use common\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Hourliesreviews */

$this->title = MyHelpers::HourlieIdtoName($model->hourlie_id);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Hourlies reviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hourliesreviews-view">
    <section class="content">
         <!-- Info boxes -->
       <div class="row">
         <div class="col-md-6">
           <div class="box box-warning">
             <div class="box-header">
               <?= Yii::t('backend', 'Review Details');?>
             </div>
                 <div class="box-body">
                   <div class="row">
                     <div class="col-xs-12">
                       <div class="col-xs-1">
                         <h4 class="text-center">Rating</h4>
                         <p class="text-center"><?= $model->rating;?></p>
                       </div>
                       <div class="col-xs-3">
                         <h4 class="text-center">Date</h4>
                         <p class="text-center"><?= $model->date;?></p>
                       </div>
                       <div class="col-xs-8">
                         <p class="pull-right">
                             <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                             <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
                                 'class' => 'btn btn-danger',
                                 'data' => [
                                     'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                                     'method' => 'post',
                                 ],
                             ]) ?>
                         </p>
                       </div>
                     </div>
                   </div>
                 </div>
            </div>
           <div class="box box-primary">
             <div class="box-header">
               <?= Yii::t('backend', 'Review');?>
             </div>
                 <div class="box-body">
                   <div class="row">
                     <div class="col-xs-12">
                       <div class="col-xs-2">
                         <img class="img-circle" height="50px" src="<?= MyHelpers::IdtoPic($model->user_id);?>" alt="">
                       </div>
                       <div class="col-xs-10">
                         <?= $model->review;?>
                       </div>
                     </div>
                   </div>
                 </div>
            </div>
            <div class="box box-success">
              <div class="box-header">
                <?= Yii::t('backend', 'Reply');?>
              </div>
                  <div class="box-body">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="col-xs-2">
                          <img class="img-circle" height="50px" src="<?= MyHelpers::IdtoPic($model->freelancer_id);?>" alt="">
                        </div>
                        <div class="col-xs-10">
                          <?= $model->replies;?>
                        </div>
                      </div>
                    </div>
                  </div>
             </div>
          </div>
       </div>
     </section>

</div>
