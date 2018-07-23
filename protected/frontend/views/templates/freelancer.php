<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HourliesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Freelancers';
$emptyResult = '<div style="text-align:center"><h1>'.Yii::t('frontend', 'There are no freelancers that match your criteria').'<br />
Please try another search.</div>';
?>

<div class="container">



   <div class="sidepanel">
     <?= $this->render('forms/freelancer_search', ['model' => $searchModel]); ?>
     <strong><?=Yii::t('frontend', 'User Status');?></strong>
     <ul>
         <li><?= Html::checkBox('available[]', false, ['label' => Yii::t('frontend', 'Available now'), 'value' => '1', 'class' => 'havailable']); ?></li>
     </ul>

  <strong><?=Yii::t('frontend', 'Delivery Country');?></strong>
     <ul>
         <?= $CountryList; ?>
     </ul>
     </div>


<?php Pjax::begin(['id' => 'list-view-pj']); ?>
        <div class="freelancecollumset" id="listboxss">
        <div > <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'emptyText' => $emptyResult,
                    'itemView' => 'forms/_grids/_freelancers',
                    'itemOptions' => ['class' => 'freelancers_list'],
                    'layout' => '{items}<div>{pager}</div>',
                ]); ?></div>

        </div>
        <?php Pjax::end(); ?>
</div>


<?php $script = <<<EOD

$('.havailable').change(function()
{
    updateResults();


});
$('.countrylink').change(function()
{
    updateResults();
});

function updateResults()
{
  var s = $('#freelancersearch-skills').val();
  //is
  var havailablestring = $('[class*="havailable"]:checked').map(function() { return $(this).val().toString(); } ).get().join(",");
  if(havailablestring == null)
  {
    havailablestring = '';
  }
  //Country
  var countrylinkstring = $('[class*="countrylink"]:checked').map(function() { return $(this).val().toString(); } ).get().join(",");
  if(countrylinkstring == null)
  {
    countrylinkstring = '';
  }

//Load the results
  $.pjax.reload({container: "#list-view-pj",
    replace:false,
    url: "?FreelancerSearch[available_now]="+havailablestring+"&FreelancerSearch[country_code]="+countrylinkstring+"&FreelancerSearch[skills]="+s,
    method: 'POST'});
}
EOD;
$this->registerJs($script);
?>
