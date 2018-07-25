<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%payment_requests}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $date
 * @property integer $sum
 * @property integer $job_id
 * @property integer $hourlie_id
 * @property string $withdraw_method
 * @property string $paypal_email
 */
class PaymentRequests extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%payment_requests}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'sum', 'job_id', 'hourlie_id'], 'integer'],
            [['date'], 'safe'],
            [['withdraw_method', 'paypal_email', 'payment_type'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'user_id' => Yii::t('frontend', 'User ID'),
            'date' => Yii::t('frontend', 'Date'),
            'sum' => Yii::t('frontend', 'Sum'),
            'job_id' => Yii::t('frontend', 'Job ID'),
            'hourlie_id' => Yii::t('frontend', 'Hourlie ID'),
            'withdraw_method' => Yii::t('frontend', 'Withdraw Method'),
            'paypal_email' => Yii::t('frontend', 'Paypal Email'),
        ];
    }

    /**
     * @inheritdoc
     * @return PaymentRequestsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaymentRequestsQuery(get_called_class());
    }
}
