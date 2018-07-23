<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HourliesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Members');
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
                   <th><?=Yii::t('backend', 'Username');?></th>
                   <th><?=Yii::t('backend', 'Full Name');?></th>
                   <th><?=Yii::t('backend', 'Date Reg');?></th>
                   <th><?=Yii::t('backend', 'IP Address');?></th>
                   <th><?=Yii::t('backend', 'Country');?></th>
                   <th><?=Yii::t('backend', 'View');?></th>

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
