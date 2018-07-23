<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HourliesreviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Hourliesreviews');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hourlies-index">
  <section class="content">
       <div class="row">
         <div class="col-xs-12">
           <div class="box box-warning">
             <div class="box-header">
               <?= Html::a(Yii::t('backend', 'Create Review'), ['create'], ['class' => 'btn btn-success']) ?>
             </div>
             <!-- /.box-header -->
             <div class="box-body">
               <table id="example" class="table table-bordered table-hover">
                 <thead>
                 <tr>
                   <th><?=Yii::t('backend', 'Hourlie');?></th>
                   <th><?=Yii::t('backend', 'Review');?></th>
                   <th><?=Yii::t('backend', 'Reply');?></th>
                   <th><?=Yii::t('backend', 'Rating');?></th>
                   <th><?=Yii::t('backend', 'Reviewer');?></th>
                   <th><?=Yii::t('backend', 'Freelancer');?></th>
                   <th><?=Yii::t('backend', 'Date');?></th>
                   <th><?=Yii::t('backend', 'Edit');?></th>
                 </tr>
                 </thead>
                 <tbody>
                   <?=$table;?>
                 </tbody>
               </table>
             </div>
             <!-- /.box-body -->
           </div>
           <!-- /.box -->
         </div>
       </div>
     </section>
  </div>
<?php $script = <<<EOD
$(document).ready(function() {
    $('#example').DataTable();
} );
EOD;
$this->registerJs($script);
?>
