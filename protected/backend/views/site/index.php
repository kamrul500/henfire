<?php

use yii\helpers\Html;
use common\components\MyHelpers;
/* @var $this \yii\web\View */
/* @var $content string */

$this->title = MyHelpers::WebsiteName();

?>
<section class="content">
     <!-- Info boxes -->
     <div class="row">
       <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box">
           <span class="info-box-icon bg-aqua"><i class="fa fa-<?= $currencycodelow;?>"></i></span>

           <div class="info-box-content">
             <span class="info-box-text"><?= Yii::t('backend', 'Total Revenue');?></span>
             <span class="info-box-number"><?= $curencySymbol.' '. MyHelpers::TotalEarnings();?></span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->
       <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box">
           <span class="info-box-icon bg-red"><i class="fa fa-shopping-bag"></i></span>

           <div class="info-box-content">
             <span class="info-box-text"><?= Yii::t('backend', 'Pending Payments');?></span>
             <span class="info-box-number"><?= $curencySymbol.' '.MyHelpers::PendingTransactionSum();?></span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->

       <!-- fix for small devices only -->
       <div class="clearfix visible-sm-block"></div>

       <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box">
           <span class="info-box-icon bg-green"><i class="fa fa-university"></i></span>

           <div class="info-box-content">
             <span class="info-box-text"><?= Yii::t('backend', 'Total Site Revenue');?></span>
             <span class="info-box-number"><?= $curencySymbol.' '.MyHelpers::SiteRevenue();?> <small>@<?=MyHelpers::Commission();?>%</small></span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->
       <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box">
           <span class="info-box-icon bg-yellow"><i class="fa fa-paper-plane"></i></span>

           <div class="info-box-content">
             <span class="info-box-text"><?= Yii::t('backend', 'Pending Payouts');?></span>
             <span class="info-box-number"><?= $curencySymbol.' '.MyHelpers::PendingPayouts();?></span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->
     </div>
     <!-- /.row -->
     <!-- Main row -->
     <div class="row">
       <!-- Left col -->
       <div class="col-md-8">
         <!-- TABLE: LATEST ORDERS -->
         <div class="box box-info">
           <div class="box-header with-border">
             <h3 class="box-title"><?= Yii::t('backend', 'Recently Sold Hourlies');?></h3>

             <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
               </button>
               <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
             </div>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="table-responsive">
               <table class="table no-margin">
                 <thead>
                 <tr>
                   <th><?=Yii::t('backend', 'Order ID');?></th>
                   <th><?=Yii::t('backend', 'Item');?></th>
                   <th><?=Yii::t('backend', 'Payment Status');?></th>
                   <th><?=Yii::t('backend', 'Price');?></th>
                   <th><?=Yii::t('backend', 'Bought By');?></th>
                 </tr>
                 </thead>
                 <tbody>
                 <?= $latesthourliesales;?>

                 </tbody>
               </table>
             </div>
             <!-- /.table-responsive -->
           </div>
           <!-- /.box-body -->
           <div class="box-footer clearfix">

           </div>
           <!-- /.box-footer -->
         </div>
         <!-- /.box -->
       </div>
       <!-- /.col -->

       <div class="col-md-4">
         <!-- Info Boxes Style 2 -->
         <div class="info-box bg-yellow">
           <span class="info-box-icon"><i class="fa fa-header"></i></span>

           <div class="info-box-content">
             <span class="info-box-text"><?= Yii::t('backend', 'Total Hourlies');?></span>
             <span class="info-box-number"><?= $Totalhourlies;?></span>

             <div class="progress">
               <div class="progress-bar" style="width: 100%"></div>
             </div>

             <span class="progress-description">
                   <?= Yii::t('backend', 'View all hourlies');?>
                 </span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
         <div class="info-box bg-green">
           <span class="info-box-icon"><i class="fa fa-building"></i></span>

           <div class="info-box-content">
             <span class="info-box-text"><?= Yii::t('backend', 'Total Active Jobs');?></span>
             <span class="info-box-number"><?=$Totaljobs;?></span>

             <div class="progress">
               <div class="progress-bar" style="width: 100%"></div>
             </div>
             <span class="progress-description">
                   <?= Yii::t('backend', 'View all Jobs');?>
                 </span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
         <div class="info-box bg-red">
           <span class="info-box-icon"><i class="fa fa-user"></i></span>

           <div class="info-box-content">
             <span class="info-box-text"><?= Yii::t('backend', 'Total Users');?></span>
             <span class="info-box-number"><?=$TotalUsers;?></span>

             <div class="progress">
               <div class="progress-bar" style="width: 100%"></div>
             </div>
             <span class="progress-description">
                   <?= Yii::t('backend', 'View all Users');?>
                 </span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
         <div class="info-box bg-aqua">
           <span class="info-box-icon"><i class="fa fa-user-secret"></i></span>

           <div class="info-box-content">
             <span class="info-box-text"><?= Yii::t('backend', 'Total Freelancers');?></span>
             <span class="info-box-number"><?=$TotalFreelancers;?></span>

             <div class="progress">
               <div class="progress-bar" style="width: 100%"></div>
             </div>
             <span class="progress-description">
                   <?= Yii::t('backend', 'View Freelancers');?>
                 </span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->




         <!-- /.box -->
       </div>
       <!-- /.col -->
     </div>
     <!-- /.row -->
   </section>
