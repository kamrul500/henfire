<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HourliesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Job Proposals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hourlies-index">
  <section class="content">
       <div class="row">
         <div class="col-xs-12">
           <div class="box box-warning">
             <div class="box-body">
               <table id="example" class="table table-bordered table-hover">
                 <thead>
                 <tr>

                   <th><?=Yii::t('backend', 'Job Name');?></th>
                   <th><?=Yii::t('backend', 'Freelancer');?></th>
                   <th><?=Yii::t('backend', 'Offer');?></th>
                   <th><?=Yii::t('backend', 'Decision');?></th>
                   <th><?=Yii::t('backend', 'Delivery Time');?></th>
                   <th><?=Yii::t('backend', 'Date Added');?></th>
                   <th><?=Yii::t('backend', 'View');?></th>
                 </tr>
                 </thead>
                 <tbody>
                   <?=$allproposals;?>
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
