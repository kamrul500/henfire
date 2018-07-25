<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HourliesSales */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hourlies Sales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hourlies-sales-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
            'seller_id',
            'buyer_id',
            'item_id',
            'item_name',
            'cost',
            'total_cost',
            'amount_bought',
            'paid',
            'buyer_cancelled',
            'seller_cancelled',
            'completed',
            'date_completed',
            'isEscro',
            'released_escro',
            'buyer_transaction_code',
            'payment_type',
            'buyer_paypal',
            'seller_paypal',
            'buyer_card_vault',
            'complaint',
            'complaint_message:ntext',
            'is_refunded',
            'seller_transaction_code',
            'custom_trans_id',
        ],
    ]) ?>

</div>
