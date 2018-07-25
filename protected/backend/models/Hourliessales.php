<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%hourliessales}}".
 *
 * @property integer $id
 * @property integer $seller_id
 * @property integer $buyer_id
 * @property integer $item_id
 * @property string $item_name
 * @property string $cost
 * @property string $total_cost
 * @property integer $amount_bought
 * @property string $paid_status
 * @property integer $buyer_cancelled
 * @property integer $seller_cancelled
 * @property integer $completed
 * @property string $date_completed
 * @property integer $isEscro
 * @property integer $released_escro
 * @property string $buyer_transaction_code
 * @property string $payment_type
 * @property string $buyer_paypal
 * @property string $buyer_paypal_auth
 * @property string $seller_paypal
 * @property string $buyer_card_vault
 * @property integer $complaint
 * @property string $complaint_message
 * @property integer $is_refunded
 * @property string $seller_transaction_code
 * @property string $custom_trans_id
 * @property string $our_commission
 * @property string $totalaftercommission
 * @property string $sellers_currency
 * @property string $buyers_currency
 * @property string $origional_currency_price
 * @property integer $freelancer_paid
 *
 * @property User $seller
 * @property User $buyer
 * @property Hourlies $item
 * @property User $buyerPaypal
 * @property User $sellerPaypal
 */
class Hourliessales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%hourliessales}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seller_id', 'buyer_id', 'item_id', 'amount_bought', 'buyer_cancelled', 'seller_cancelled', 'completed', 'isEscro', 'released_escro', 'complaint', 'is_refunded', 'freelancer_paid'], 'integer'],
            [['item_id', 'totalaftercommission', 'sellers_currency', 'buyers_currency', 'origional_currency_price'], 'required'],
            [['date_completed'], 'safe'],
            [['complaint_message'], 'string'],
            [['item_name', 'buyer_transaction_code', 'payment_type', 'buyer_paypal', 'buyer_paypal_auth', 'seller_paypal', 'buyer_card_vault', 'seller_transaction_code', 'custom_trans_id'], 'string', 'max' => 250],
            [['cost'], 'string', 'max' => 11],
            [['total_cost', 'origional_currency_price'], 'string', 'max' => 10],
            [['paid_status'], 'string', 'max' => 120],
            [['our_commission', 'totalaftercommission'], 'string', 'max' => 22],
            [['sellers_currency', 'buyers_currency'], 'string', 'max' => 4],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['seller_id' => 'id']],
            [['buyer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['buyer_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hourlies::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['buyer_paypal'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['buyer_paypal' => 'paypal_email']],
            [['seller_paypal'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['seller_paypal' => 'paypal_email']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'seller_id' => Yii::t('app', 'Seller ID'),
            'buyer_id' => Yii::t('app', 'Buyer ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'item_name' => Yii::t('app', 'Item Name'),
            'cost' => Yii::t('app', 'Cost'),
            'total_cost' => Yii::t('app', 'Total Cost'),
            'amount_bought' => Yii::t('app', 'Amount Bought'),
            'paid_status' => Yii::t('app', 'Paid Status'),
            'buyer_cancelled' => Yii::t('app', 'Buyer Cancelled'),
            'seller_cancelled' => Yii::t('app', 'Seller Cancelled'),
            'completed' => Yii::t('app', 'Completed'),
            'date_completed' => Yii::t('app', 'Date Completed'),
            'isEscro' => Yii::t('app', 'Is Escro'),
            'released_escro' => Yii::t('app', 'Released Escro'),
            'buyer_transaction_code' => Yii::t('app', 'Buyer Transaction Code'),
            'payment_type' => Yii::t('app', 'Payment Type'),
            'buyer_paypal' => Yii::t('app', 'Buyer Paypal'),
            'buyer_paypal_auth' => Yii::t('app', 'Buyer Paypal Auth'),
            'seller_paypal' => Yii::t('app', 'Seller Paypal'),
            'buyer_card_vault' => Yii::t('app', 'Buyer Card Vault'),
            'complaint' => Yii::t('app', 'Complaint'),
            'complaint_message' => Yii::t('app', 'Complaint Message'),
            'is_refunded' => Yii::t('app', 'Is Refunded'),
            'seller_transaction_code' => Yii::t('app', 'Seller Transaction Code'),
            'custom_trans_id' => Yii::t('app', 'Custom Trans ID'),
            'our_commission' => Yii::t('app', 'Our Commission'),
            'totalaftercommission' => Yii::t('app', 'Totalaftercommission'),
            'sellers_currency' => Yii::t('app', 'Sellers Currency'),
            'buyers_currency' => Yii::t('app', 'Buyers Currency'),
            'origional_currency_price' => Yii::t('app', 'Origional Currency Price'),
            'freelancer_paid' => Yii::t('app', 'Freelancer Paid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(User::className(), ['id' => 'seller_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyer()
    {
        return $this->hasOne(User::className(), ['id' => 'buyer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Hourlies::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyerPaypal()
    {
        return $this->hasOne(User::className(), ['paypal_email' => 'buyer_paypal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSellerPaypal()
    {
        return $this->hasOne(User::className(), ['paypal_email' => 'seller_paypal']);
    }
}
