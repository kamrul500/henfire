<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Job */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id, 'user_id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'title',
            'description:ntext',
            'category',
            'subCat',
            'date_created',
            'date_expire',
            'material:ntext',
            'promoted',
            'paid',
            'success',
            'isEscro',
            'released_escro',
            'freelancer',
            'freelancer_paypal',
            'buyer_cancelled',
            'seller_cancelled',
            'date_completed',
            'worktype',
            'currency',
            'budget',
            'agreed_price',
            'experience_level',
            'buyer_transaction_code',
            'payment_type',
            'buyer_paypal',
            'buyer_paypal_auth',
            'seller_paypal',
            'buyer_card_vault',
            'complaint',
            'complaint_message:ntext',
            'custom_trans_id',
            'our_commission',
            'totalaftercommission',
            'sellers_currency',
            'buyers_currency',
            'origional_currency_price',
        ],
    ]) ?>

</div>
