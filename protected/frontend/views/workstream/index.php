<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\WorkstreamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Workstreams');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workstream-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('frontend', 'Create Workstream'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'job_id',
            'freelancer_id',
            'user_id',
            'comment:ntext',
            // 'upload_zip:ntext',
            // 'user_replied',
            // 'freelancer_replied',
            // 'is_hourlie:url',
            // 'is_job',
            // 'is_finished',
            // 'admin_flagged',
            // 'freelancer_flagged',
            // 'member_flagged',
            // 'flagged_comment:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
