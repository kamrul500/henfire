<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use common\components\MyHelpers;
use Symfony\Component\Intl\Intl;

$this->title = Yii::t('backend','Payment Requests');
?>
<section class="content">
     <!-- Info boxes -->
  <div class="row">
    <div class="box box-danger">
           <div class="box-header with-border">
             <h3 class="box-title"><?=Yii::t('backend', 'All Payment Requests');?></h3>
           </div>
           <div class="box-body">
             <table id="example" class="table table-bordered table-hover">
               <thead>
               <tr>
                 <th><?=Yii::t('backend', 'Freelancer');?></th>
                 <th><?=Yii::t('backend', 'Job');?></th>
                 <th><?=Yii::t('backend', 'Amount');?></th>
                 <th><?=Yii::t('backend', 'Method');?></th>
                 <th><?=Yii::t('backend', 'PayPal Email');?></th>
                 <th><?=Yii::t('backend', 'Function');?></th>

               </tr>
               </thead>
               <tbody>
                 <?=$PaymentsTable;?>
               </tbody>
             </table>
           </div>
           <!-- /.box-body -->
         </div>
  </div>
</section>
<?php $script = <<<EOD
$(document).ready(function() {
    $('#example').DataTable();
} );
EOD;
$this->registerJs($script);
?>
