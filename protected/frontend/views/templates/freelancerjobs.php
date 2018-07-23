<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use app\models\JobSearch;
use yii\db\Expression;
use common\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Jobs');


/*$countlevelexpert = JobSearch::find()->where(['experience_level' => 3])->andwhere(['>', 'date_expire', new Expression('NOW()')])->all();
$numberpelevelExpert = count($countlevelexpert);

$countlevelIntermediate = JobSearch::find()->where(['experience_level' => 2])->andwhere(['>', 'date_expire', new Expression('NOW()')])->all();
$numberpelevelIntermediate = count($countlevelIntermediate);

$countlevelEntry = JobSearch::find()->where(['experience_level' => 1])->andwhere(['>', 'date_expire', new Expression('NOW()')])->all();
$numberpelevelEntry = count($countlevelEntry);*/

?>

<nav class="navbar-minimenu navbar" data-spy="affix" data-offset-top="30">
<div class="container-fluid">
  <ul class="nav navbar-nav">
    <?= MyHelpers::categori_menu_jobs();?>
  </ul>
</div>
</nav>
<div class="container">
    <div class="col-md-19">

    <div class="sidepanel">
      <?= $this->render('forms/freelancerjobs_search', ['model' => $searchModel]); ?>
      <strong><?= Yii::t('frontend','Experience level');?></strong>
      <ul>
          <li><?= Html::checkBox('experience[]', false, ['label' => Yii::t('frontend','Entry level'), 'value' => '1', 'class' => 'explevel']); ?></li>
          <li><?= Html::checkBox('experience[]', false, ['label' => Yii::t('frontend','Intermediate'), 'value' => '2', 'class' => 'explevel']); ?></li>
          <li><?= Html::checkBox('experience[]', false, ['label' => Yii::t('frontend','Expert'), 'value' => '3', 'class' => 'explevel']); ?></li>
      </ul>

          <strong><?= Yii::t('frontend','CATEGORIES')?></strong>
          <ul>
            <?=$category; ?>
          </ul>

    </div>
    <div class="col-md-9 jobsfound">
<?php Pjax::begin(['id' => 'list-view-pj']); ?>
  <?=  ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => 'forms/_grids/freelancerjobs_jobs',
                        'itemOptions' => ['class' => 'jobslist'],

                        'summary' => "<div class='jobscount'>{totalCount} ".Yii::t('frontend', 'Jobs Found')."</div>",
                        'layout' => '<div>{summary}</div><div>{items}</div><div>{pager}</div>',
                    ]); ?><?php Pjax::end(); ?>
    </div>


    </div>

</div>

<?php $script = <<<EOD

$('.explevel').change(function()
{
    updateResults();


});
$('.catclass').change(function()
{
    updateResults();


});

function updateResults()
{
  var s = $('#freelancejobssearch-title').val();
  //time to complete
  var explevelstring = $('[class*="explevel"]:checked').map(function() { return $(this).val().toString(); } ).get().join(",");
  if(explevelstring == null)
  {
    explevelstring = '';
  }

  var catclassstring = $('[class*="catclass"]:checked').map(function() { return $(this).val().toString(); } ).get().join(",");
  if(catclassstring == null)
  {
    catclassstring = '';
  }

//Load the results
  $.pjax.reload({container: "#list-view-pj",
    replace:false,
    url: "?FreelanceJobsSearch[experience_level]="+explevelstring+"&FreelanceJobsSearch[category]="+catclassstring+"&FreelanceJobsSearch[title]="+s,
    method: 'POST'});
}

$('.navbar .dropdown').hover(function() {
		  $(this).find('.dropdown-menu').first().stop(true, true).slideDown(150);
		}, function() {
		  $(this).find('.dropdown-menu').first().stop(true, true).slideUp(105)
		});
EOD;
$this->registerJs($script);
?>
