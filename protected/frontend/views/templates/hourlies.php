<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use dosamigos\multiselect\MultiSelect;
use yii\helpers\Url;
use common\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HourliesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Hourlies');
$emptyResult = '<div style="text-align:center"><h1>'.Yii::t('frontend', 'Oops! We haven\'t found any results for this.').'<br />
'.Yii::t('frontend', 'Try another search, or why not Post a job and get a custom proposal?').' </h1>'.Html::a(Yii::t('frontend', 'POST JOB'), ['job/new?r=post_new_job'], ['class' => 'btn btn-default']).'</div>';
?>


<nav class="navbar-minimenu navbar" data-spy="affix" data-offset-top="30">
<div class="container-fluid">
  <ul class="nav navbar-nav">
    <?= MyHelpers::categori_menu();?>
  </ul>
</div>
</nav>
<div class="container">

    	<div class="sidepanel">
        <?= $this->render('../templates/forms/hourlies_search', ['model' => $searchModel]); ?>
        <a href="http://localhost/henfire/hourlies/design-a-logo-for-you-today-50">here</a>
        <strong>Sort By</strong>
        <ul>
          <li><?= Html::checkBox('sortby[]', true, ['label' => Yii::t('frontend', 'Featured'), 'value' => 'sort=-promoted', 'class' => 'sortby checked']); ?></li>
          <li><?= Html::checkBox('sortby[]', false, ['label' => Yii::t('frontend', 'Cost Highest'), 'value' => 'sort=-cost', 'class' => 'sortby']); ?></li>
          <li><?= Html::checkBox('sortby[]', false, ['label' => Yii::t('frontend', 'Cost Lowest'), 'value' => 'sort=cost', 'class' => 'sortby']); ?></li>
        </ul>
        <strong>Delivery Time</strong>
        <ul>
            <li><?= Html::checkBox('available[]', false, ['label' => Yii::t('frontend', 'Within 1 Day'), 'value' => '1', 'class' => 'havailable']); ?></li>
            <li><?= Html::checkBox('available[]', false, ['label' => Yii::t('frontend', 'Within 2 Days'), 'value' => '2', 'class' => 'havailable']); ?></li>
            <li><?= Html::checkBox('available[]', false, ['label' => Yii::t('frontend', 'Within 3 Days'), 'value' => '3', 'class' => 'havailable']); ?></li>
            <li><?= Html::checkBox('available[]', false, ['label' => Yii::t('frontend', '4+ Days'), 'value' => '4', 'class' => 'havailable']); ?></li>
        </ul>

     <strong><?= Yii::t('frontend', 'Freelancer Country');?></strong>
        <ul>
            <?= $CountryList; ?>
        </ul>
        </div>



<?php Pjax::begin([
  'id' => 'list-view-pj',
  'enablePushState' => true,  // I would like the browser to change link
  'timeout' => 10000, // Timeout needed
  'scrollTo' => 0,
]); ?>
        <div class="acollumset" id="listboxss">
        <div > <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'emptyText' => $emptyResult,
                    'itemView' => 'forms/_grids/_hourlies',
                    'itemOptions' => ['class' => 'itemlist'],
                    'options' => ['data-pjax' => true ], //this is for pjax
                    'layout' => '{items}{pager}',
                    'pager' => [
                        'maxButtonCount' => 20,
                        'options' => [
                            'class' => 'pagination col-xs-12'
                        ]
                    ],
                ]); ?></div>

        </div>
        <?php Pjax::end(); ?>
</div>

<?php $script = <<<JS
$('.sortby').change(function()
{
    updateResults();
});
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
  var subCat = getUrlParameter('HourliesSearch[subCat]');
  var category = getUrlParameter('HourliesSearch[category]');
  var showcat = '';
  var showsub = '';
  if(category != null)
  {
    var showcat = '&HourliesSearch[category]='+category;
  }
  if(subCat != null)
  {
    var showsub = '&HourliesSearch[subCat]='+subCat;
  }
  var s = $('#hourliessearch-title').val();
  //time to complete
  var havailablestring = $('[class*="havailable"]:checked').map(function() { return $(this).val().toString(); } ).get().join(",");
  if(havailablestring == null)
  {
    havailablestring = '';
  }
  var sortbystring = $('[class*="sortby"]:checked').map(function() { return $(this).val().toString(); } ).get().join("&");
  if(sortbystring == null)
  {
    sortbystring = '';
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
    url: "?HourliesSearch[delivery_time]="+havailablestring+"&HourliesSearch[country_code]="+countrylinkstring+"&HourliesSearch[title]="+s+''+showsub+''+showcat+'&'+sortbystring,
    method: 'POST'});
}
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
$('.navbar .dropdown').hover(function() {
		  $(this).find('.dropdown-menu').first().stop(true, true).slideDown(150);
		}, function() {
		  $(this).find('.dropdown-menu').first().stop(true, true).slideUp(105)
		});
JS;
$this->registerJs($script);
?>
