<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\JobCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Categories');
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
             <?= Html::a(Yii::t('backend', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <table id="example" class="table table-bordered table-hover">
               <thead>
               <tr>
                 <th><?=Yii::t('backend', 'Category');?></th>
                 <th><?=Yii::t('backend', 'Sub Category');?></th>
                 <th><?=Yii::t('backend', 'Edit & Delete');?></th>

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
