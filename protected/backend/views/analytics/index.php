<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use common\components\MyHelpers;
use Symfony\Component\Intl\Intl;

/* @var $this yii\web\View */
/* @var $model app\models\Hourlieworkstream */

$this->title = Yii::t('backend','Analytics');
?>
<section class="content">
     <!-- Info boxes -->
  <div class="row">
    <div class="box box-danger">
           <div class="box-header with-border">
             <h3 class="box-title"><?=Yii::t('backend', 'Analytics Code');?></h3>
           </div>
           <div class="box-body">
             <div class="row">
               <div class="col-xs-5">
                 <?php $form = ActiveForm::begin(['action' => ['settings/analytics'],'options' => ['enctype' => 'multipart/form-data']]) ?>
                 <?= $form->field($model, 'analytics')->textarea(['rows' => '6']) ?>
                 <?= Html::submitButton('Submit') ?>
                 <?php ActiveForm::end(); ?>
               </div>

             </div>
           </div>
           <!-- /.box-body -->
         </div>
  </div>
</section>
