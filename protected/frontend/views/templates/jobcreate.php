<?php


/* @var $this yii\web\View */
/* @var $model app\models\Job */

$this->title = Yii::t('frontend', 'Create Job');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
	<div class="col-md-12 web-view update_profile">
                <div class="col-md-8">
                    <h2><?=Yii::t('frontend', 'Get your job done')?></h2>
                    <h4><?=Yii::t('frontend', 'Post a Job for Free - Start receiving proposals within minutes')?></h4>
                    <?= $this->render('forms/job_form', [
                        'model' => $model,
                    ]) ?>
                </div>
                <div class="col-md-4">
                	<div class="text-center">
                    	<h2><strong><?=Yii::t('frontend', 'USEFUL TIPS')?></strong></h2>
                    </div>
                        	<div class="tips">
                                <ol type="1" class="text-left">
                                    <li><?=Yii::t('frontend', 'Describe your Job in as much detail as you can comfortably reveal - it will increase the quality of proposals you receive and shorten the selection process.')?></li>
                                    <li><?=Yii::t('frontend', 'Upload as much relevant information (pictures, documents, specifications, links, etc) as possible to get a realistic quote.')?></li>
                                    <li><?=Yii::t('frontend', 'Match the experience level to your requirements – remember, you’re looking for the best you can afford, not the cheapest you can get.')?></li>
                                </ol>
                        	</div>
                    </div>
                </div>
        </div>
</div>
