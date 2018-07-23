<?php $this->title = Yii::$app->user->identity->username.'\'s '.Yii::t('frontend', 'Dashboard'); ?>

<div class="container dashinfotop">
    <div class="web-view">
      <div class="row">
        <div class="col-xs-4 col-sm-4 text-center">
  				<h1 class="setorange"><?=$sumopenjobs;?></h1>
  				<p><small><?=Yii::t('frontend','ACTIVE JOBS')?></small></p>
  			</div>
  			<div class="col-xs-4 col-sm-4 text-center">
  				<h1 class="setgreen"><?= $openhourlies;?></h1>
  				<p><small><?=Yii::t('frontend','ACTIVE HOURLIES')?></small></p>
  			</div>
  			<div class="col-xs-4 col-sm-4 text-center">
  				<h1 class="setlightorange"><?=$totalhourlies;?></h1>
  				<p><small><?=Yii::t('frontend','TOTAL HOURLIES')?></small></p>
  			</div>
      </div>
    </div>
</div>
<div class="container">
    <div class="web-view">
      <div class="row">
        <div class="col-sm-12">
          <div class=""><h4><?=Yii::t('frontend','ACTIVE JOBS')?></h4></div>
          <div class="activelist"><?= $activejobslist;?></div>
        </div>
      </div>
    </div>
</div>

<div class="container">
    <div class="web-view">
      <div class="row">
        <div class="col-sm-12">
          <div class=""><h4><?=Yii::t('frontend','ACTIVE HOURLIES')?></h4></div>
          <div class="activelist"><?= $activehourlieslist;?></div>
        </div>
      </div>
    </div>
</div>
