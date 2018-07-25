<?php


/* @var $this yii\web\View */
/* @var $model app\models\Hourlies */

$this->title = 'Create Hourlies';
$this->params['breadcrumbs'][] = ['label' => 'Hourlies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
	<div class="col-md-12 web-view update_profile">
                <div class="col-md-8">
                    <h2><?=Yii::t('frontend', 'Post an Hourlie');?></h2>
                    <h4><?=Yii::t('frontend', 'Fill out the form to post your Hourlies');?></h4>
                    <?= $this->render('forms/hourlies_form', [
                        'model' => $model,
                    ]) ?>
                </div>
                <div class="col-md-4">
                	<div class="text-center">
                    	<h2><strong><?=Yii::t('frontend', 'SELLER TIPS');?></strong></h2>
                    </div>
                        	<div class="tips">
                                <ol type="1" class="text-left">
                                    <li><?=Yii::t('frontend', 'Tell your personal story, how you got to being a freelancer. There is no substitute for the real you');?> </li>
                                    <li><?=Yii::t('frontend', 'Reveal your passion and drive. What gets you up in the morning?');?></li>
                                    <li><?=Yii::t('frontend', 'Why did you choose to become a freelancer?');?></li>
                                    <li><?=Yii::t('frontend', 'Upload a high quality cover image and a real photo of yourself to engage Buyers');?></li>
                                    <li><?=Yii::t('frontend', 'Keep it real!');?></li>
                                </ol>
                        	</div>
                     <div class="text-center">
                    	<h2><strong><?=Yii::t('frontend', 'WHAT TO AVOID');?></strong></h2>
                    </div>
                        	<div class="tips">
                                <ol type="1" class="text-left">
                                    <li><?=Yii::t('frontend', 'No corporate boring stuff... keep your Profile light and human. Buyers don’t hire a resume they want to hire a person.');?></li>
                                    <li><?=Yii::t('frontend', 'No logos or imagery');?></li>
                                    <li><?=Yii::t('frontend', 'No contact details. The integrity of the PPH system is paramount to our community.');?></li>
                                    <li><?=Yii::t('frontend', 'No resumes or CVs...keep it real!');?></li>
                                  
                                </ol>
                        	</div>
                    </div>
                </div>
        </div>
</div>
