<?php


/* @var $this yii\web\View */
/* @var $model app\models\Job */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Job',
]).$model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'freelance-jobs'), 'url' => ['/freelance-jobs']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="container">
<div class="col-md-12 web-view update_profile">
                <div class="col-md-8">
                    <h2>Edit your Job</h2>
                    <h4>Fill in your Job information</h4>
                    <?= $this->render('forms/job_update', [
                        'model' => $model,
                    ]) ?>
                </div>
                <div class="col-md-4">
                	<div class="text-center">
                    	<h2><strong>SELLER TIPS</strong></h2>
                    </div>
                        	<div class="tips">
                                <ol type="1" class="text-left">
                                    <li>Tell your personal story, how you got to being a freelancer. There is no substitute for the real ‘you’ story :)</li>
                                    <li>Reveal your passion and drive. What gets you up in the morning?</li>
                                    <li>Why did you choose to become a freelancer?</li>
                                    <li>Upload a high quality cover image and a real photo of yourself to engage Buyers</li>
                                    <li>Keep it real!</li>
                                </ol>
                        	</div>
                     <div class="text-center">
                    	<h2><strong>WHAT TO AVOID</strong></h2>
                    </div>
                        	<div class="tips">
                                <ol type="1" class="text-left">
                                    <li>No corporate boring stuff... keep your Profile light and ‘human’. Buyers don’t hire a ‘resume’ they want to hire a person.</li>
                                    <li>No logos or imagery</li>
                                    <li>No contact details. The integrity of the PPH system is paramount to our community.</li>
                                    <li>No resumes or CVs...keep it real!</li>
                                    <li>No corporate boring stuff... keep your Profile light and ‘human’. Buyers don’t hire a ‘resume’ they want to hire a person.</li>
                                </ol>
                        	</div>
                    </div>
                </div>
        </div>
</div>
