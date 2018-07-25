<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HourliesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Hourlies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hourlies-index">
  <section class="content">
       <div class="row">
         <div class="col-xs-12">
           <div class="box box-warning">
             <div class="box-header">
               <?= Html::a(Yii::t('backend', 'Create Hourlie'), ['create'], ['class' => 'btn btn-success']) ?>
             </div>
             <!-- /.box-header -->
             <div class="box-body">
               <table id="example" class="table table-bordered table-hover">
                 <thead>
                 <tr>
                   <th><?=Yii::t('backend', 'Title');?></th>
                   <th><?=Yii::t('backend', 'User');?></th>
                   <th><?=Yii::t('backend', 'Price');?></th>
                   <th><?=Yii::t('backend', 'Date Created');?></th>
                   <th><?=Yii::t('backend', 'Category');?></th>
                   <th><?=Yii::t('backend', 'Status');?></th>
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
