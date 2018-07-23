<?php $this->title = Yii::$app->user->identity->username.'\'s Dashboard'; ?>
<div class="container">
    <div class="col-md-12 web-view">
    	<div class="col-md-3">
    		<p>Welcome <?=Yii::$app->user->identity->full_name;?></p>
				<h3>Seller Dashboard</h3>
    	</div>
			<div class="col-md-3 text-center">
				<h1 class="setorange"><?=$sumopenjobs;?></h1>
				<p><small>OPEN JOBS</small></p>
			</div>
			<div class="col-md-3 text-center">
				<h1 class="setgreen"><?= $wumworkstream;?></h1>
				<p><small>WORKSTREAMS IN-PROGRESS</small></p>
			</div>
			<div class="col-md-3 text-center">
				<h1 class="setlightorange"><?=$sumpending;?></h1>
				<p><small>OUTSTANDING INVOICES</small></p>
			</div>
      <div class="pull-right"><?=$sellerdashboard?></div>
    </div>
	</div>
	<div class="container">
		<div class="col-md-5 web-view nav-profile">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home">OPEN JOBS</a></li>
			</ul>
			<div class="tab-content">
				<div id="home" class="tab-pane fade in active">
				<div class='dashboardjob'>
					<?=$openjobsreturn;?>
				</div>
				</div>
		  </div>
		</div>
		<div class="col-md-5 web-view pull-right nav-profile">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home">WORKSTREAMS IN-PROGRESS</a></li>
			</ul>
			<div class="tab-content">
				<div id="home" class="tab-pane fade in active">
				<?=$openworkstreams;?>
				</div>
		  </div>
		</div>
  </div>
