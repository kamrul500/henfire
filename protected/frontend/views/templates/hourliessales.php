<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HourliesSalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Hourlies Sales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hourlies-sales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Hourlies Sales'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'seller_id',
            'buyer_id',
            'item_id',
            'item_name',
            // 'cost',
            // 'total_cost',
            // 'amount_bought',
            // 'paid',
            // 'buyer_cancelled',
            // 'seller_cancelled',
            // 'completed',
            // 'date_completed',
            // 'isEscro',
            // 'released_escro',
            // 'buyer_transaction_code',
            // 'payment_type',
            // 'buyer_paypal',
            // 'seller_paypal',
            // 'buyer_card_vault',
            // 'complaint',
            // 'complaint_message:ntext',
            // 'is_refunded',
            // 'seller_transaction_code',
            // 'custom_trans_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
