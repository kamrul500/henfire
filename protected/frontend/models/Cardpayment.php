<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "freelancer".
 *
 * @property int $id
 * @property int $user_id
 * @property string $username
 * @property string $full_name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class cardpayment extends \yii\db\ActiveRecord
{
    public function rules()
    {
        return [
            [['payment_type', 'purchasedetails', 'expMonth', 'cardpayment', 'expYear', 'ccV2', 'cardFname', 'cardLname'.'Email'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'payment_type' => Yii::t('frontend', 'payment_type'),
            'purchasedetails' => Yii::t('frontend', 'purchasedetails'),
            'expMonth' => Yii::t('frontend', 'Month Expire'),
            'expYear' => Yii::t('frontend', 'Year Expire'),
            'ccV2' => Yii::t('frontend', 'CCV2'),
            'cardFname' => Yii::t('frontend', 'First Name'),
            'cardLname' => Yii::t('frontend', 'Last Name'),
        ];
    }
}
