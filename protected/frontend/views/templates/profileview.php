<?php
$this->title = $model->full_name; ?>
<div class="container">
	<div class="profile-view">
            <div class="col-md-12 profile_header" <?= $style; ?>>
                <div class="<?= $profile_top; ?>">
                <div class="star-rarting">
                <?=$starratings?>
                </div>
                    <div class="col-md-2">
                        <div class="profile_picture" style="background-image:url('<?= $model->profile_picture; ?>')"></div>
                    </div>
                    <div class="col-md-3 profile_name <?= $textcolour; ?>">
                        <h4><?= $model->full_name; ?></h4>
                        <?= $model->occupation; ?>
                    </div>
                    <div class="col-md-4"><?= $add_cover; ?></div>
                    <div class="col-md-2 text-right profile_boost">

                    </div>
                    <div class="col-md-1 text-right profile_update">
                        <?=$contact;?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <div class="company_name">
                            "<?= $model->company_name; ?>"
                        </div>
                        <div class="introduction">
                            <?= $introduction; ?>
                        </div>
                        <div class="hourlie_rate">
                            <span class="fa fa-fw fa-money green"></span> <?=Symfony\Component\Intl\Intl::getCurrencyBundle()->getCurrencySymbol($mycurrency).' '.round($price); ?> /hr
                        </div>
                         <div class="available_now">
                            <?= $available_now; ?>
                        </div>
                        <div class="online_now">
                            <?= $onlinenow?>
                        </div>
                        <div class="profile_country">
                            <span class="fa fa-fw fa-map-marker"></span> <?= $model->city; ?>, <?= $model->country; ?>
                        </div>



                        <div class="profile_heading">
                            <h5><strong><span class="fa fa-fw fa-circle-o"></span><?=Yii::t('frontend', 'SKILLS');?></strong></h5>
                        </div>
                        <div class="tag_list">
                        <ul class="tags">

                       <?=$skills;?>
                        </ul>
                        </div>
                        <div class="profile_heading">
                            <h5><strong><span class="fa fa-fw fa-circle-o"></span><?=Yii::t('frontend', 'BUYER STATS');?></strong></h5>
                        </div>
                        	<div class="col-md-10 spaced">
														<?=Yii::t('frontend', 'Projects Completed');?>
                            </div>
                            <div class="col-md-1 text-right">
                            	<?=$projectescompleted; ?>
                            </div>
                        	<div class="col-md-10 spaced">
														<?=Yii::t('frontend', 'Sellers worked with');?>
                            </div>
                            <div class="col-md-1 text-right">
                            	<?= $hourliessales; ?>
                            </div>
                        	<div class="col-md-6 spaced">
														<?=Yii::t('frontend', 'Last project');?>

                            </div>
                            <div class="col-md-6 text-right">
                            	<?= $lastproject;?>
                            </div>
                    </div>
                    <div class="col-md-9 nav-profile">
                        <ul class="nav nav-tabs nav-justified">
                          <li class=""><a data-toggle="tab" href="#home"><?=Yii::t('frontend', 'My Portfolio');?></a></li>
                          <li class="active"><a data-toggle="tab" href="#menu1"><?=Yii::t('frontend', 'My Hourlies');?></a></li>
                        </ul>
                        <div class="tab-content">
                          <div id="home" class="tab-pane fade in">
                          <?=$myportfolio; ?>
                           <?=$widgets; ?>
                          </div>
                          <div id="menu1" class="tab-pane fade in active">
                            <?=$myhourlies; ?>
                          </div>
                        </div>
                    </div>
                </div>
             </div>
         </div>
    </div>
    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?=Yii::t('frontend', 'About');?> <?= $model->full_name; ?></h4>
      </div>
      <div class="modal-body">
        <p><?= $model->introduction; ?></p>
      </div>
    </div>
  </div>
</div>
</div>
