<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use dosamigos\multiselect\MultiSelect;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JobProposalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Job Proposals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container web-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

<?php Pjax::begin(['id' => 'list-view-pj']); ?>

<div class="col-md-12">
 <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'emptyText' => $emptyResult,
                    'itemView' => 'forms/_grids/_proposals',
                    'itemOptions' => ['class' => 'proposals'],
					'summary' => "<div class='jobscount'>{totalCount} ".Yii::t('frontend', 'Proposal Found')."</div>",
                    'layout' => '<div class="pull-right">{summary}</div><div>{items}</div><div>{pager}</div>',
                ]); ?>
        <?php Pjax::end(); ?>
        </div>
</div>

