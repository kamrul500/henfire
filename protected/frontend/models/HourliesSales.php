<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hourliessales".
 *
 * @property int $id
 * @property int $seller_id
 * @property int $buyer_id
 * @property int $item_id
 * @property string $item_name
 * @property int $cost
 * @property int $total_cost
 * @property int $amount_bought
 * @property int $paid
 * @property int $buyer_cancelled
 * @property int $seller_cancelled
 * @property int $completed
 * @property string $date_completed
 * @property int $isEscro
 * @property int $released_escro
 * @property string $buyer_transaction_code
 * @property string $payment_type
 * @property string $buyer_paypal
 * @property string $seller_paypal
 * @property string $buyer_card_vault
 * @property int $complaint
 * @property string $complaint_message
 * @property int $is_refunded
 * @property string $seller_transaction_code
 * @property string $custom_trans_id
 */
class HourliesSales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%hourliessales}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seller_id', 'buyer_id', 'item_id', 'origional_currency_price', 'cost', 'total_cost', 'amount_bought', 'buyer_cancelled', 'seller_cancelled', 'completed', 'isEscro', 'released_escro', 'complaint', 'is_refunded'], 'integer'],
            [['item_id'], 'required'],
            [['date_completed', 'our_commission', 'totalaftercommission'], 'safe'],
            [['complaint_message'], 'string'],
            [['item_name', 'buyer_transaction_code', 'buyers_currency', 'sellers_currency', 'payment_type', 'paid_status', 'buyer_paypal', 'seller_paypal', 'buyer_card_vault', 'seller_transaction_code', 'custom_trans_id'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'seller_id' => Yii::t('frontend', 'Seller ID'),
            'buyer_id' => Yii::t('frontend', 'Buyer ID'),
            'item_id' => Yii::t('frontend', 'Item ID'),
            'item_name' => Yii::t('frontend', 'Item Name'),
            'cost' => Yii::t('frontend', 'Cost'),
            'total_cost' => Yii::t('frontend', 'Total Cost'),
            'amount_bought' => Yii::t('frontend', 'Amount Bought'),
            'paid_status' => Yii::t('frontend', 'Paid'),
            'buyer_cancelled' => Yii::t('frontend', 'Buyer Cancelled'),
            'seller_cancelled' => Yii::t('frontend', 'Seller Cancelled'),
            'completed' => Yii::t('frontend', 'Completed'),
            'date_completed' => Yii::t('frontend', 'Date Completed'),
            'isEscro' => Yii::t('frontend', 'Is Escro'),
            'released_escro' => Yii::t('frontend', 'Released Escro'),
            'buyer_transaction_code' => Yii::t('frontend', 'Buyer Transaction Code'),
            'payment_type' => Yii::t('frontend', 'Payment Type'),
            'buyer_paypal' => Yii::t('frontend', 'Buyer Paypal'),
            'seller_paypal' => Yii::t('frontend', 'Seller Paypal'),
            'buyer_card_vault' => Yii::t('frontend', 'Buyer Card Vault'),
            'complaint' => Yii::t('frontend', 'Complaint'),
            'complaint_message' => Yii::t('frontend', 'Complaint Message'),
            'is_refunded' => Yii::t('frontend', 'Is Refunded'),
            'seller_transaction_code' => Yii::t('frontend', 'Seller Transaction Code'),
            'custom_trans_id' => Yii::t('frontend', 'Custom Trans ID'),
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @return HourliessalesQuery the active query used by this AR class
     */
    public static function find()
    {
        return new HourliessalesQuery(get_called_class());
    }
}
