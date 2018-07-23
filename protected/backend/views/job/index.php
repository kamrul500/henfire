<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel app\models\JobCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Jobs List');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-category-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!-- Main content -->
<section class="content">
     <div class="row">
       <div class="col-xs-12">
         <div class="box box-primary">
           <div class="box-header">
             <?= Html::a(Yii::t('backend', 'Create Job'), ['create'], ['class' => 'btn btn-success']) ?>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <table id="example" class="table table-bordered table-hover">
               <thead>
               <tr>
                     <th><?=Yii::t('backend', 'Title');?></th>
                     <th><?=Yii::t('backend', 'Status');?></th>
                     <th><?=Yii::t('backend', 'User');?></th>
                     <th><?=Yii::t('backend', 'Freelancer');?></th>
                     <th><?=Yii::t('backend', 'Budget');?></th>
                     <th><?=Yii::t('backend', 'Category');?></th>
                     <th><?=Yii::t('backend', 'Date Created');?></th>
                     <th><?=Yii::t('backend', 'Date Expire');?></th>
                     <th><?=Yii::t('backend', 'Promoted');?></th>
                     <th><?=Yii::t('backend', 'Escro');?></th>
                     <th><?=Yii::t('backend', 'Issues');?></th>
                     <th><?=Yii::t('backend', 'Stream');?></th>

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
