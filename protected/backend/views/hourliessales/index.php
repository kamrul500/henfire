<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HourliesreviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Hourlie Sales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hourlies-index">
  <section class="content">
       <div class="row">
         <div class="col-xs-12">
           <div class="box box-warning">

             <!-- /.box-header -->
             <div class="box-body">
               <table id="example" class="table table-bordered table-hover">
                 <thead>
                 <tr>
                   <th><?=Yii::t('backend', 'Order ID');?></th>
                   <th><?=Yii::t('backend', 'Item');?></th>
                   <th><?=Yii::t('backend', 'Payment Status');?></th>
                   <th><?=Yii::t('backend', 'Progress');?></th>
                   <th><?=Yii::t('backend', 'Price');?></th>
                   <th><?=Yii::t('backend', 'Bought By');?></th>
                   <th><?=Yii::t('backend', 'Workflow');?></th>
                 </tr>
                 </thead>
                 <tbody>
                   <?=$latesthourliesales;?>
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
