<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Workstream */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Workstreams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workstream-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('frontend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('frontend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('frontend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'job_id',
            'freelancer_id',
            'user_id',
            'comment:ntext',
            'upload_zip:ntext',
            'user_replied',
            'freelancer_replied',
            'is_hourlie:url',
            'is_job',
            'is_finished',
            'admin_flagged',
            'freelancer_flagged',
            'member_flagged',
            'flagged_comment:ntext',
        ],
    ]) ?>

</div>
