<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%deposits}}".
 *
 * @property integer $id
 * @property integer $sum
 * @property integer $user_id
 * @property string $currency
 * @property string $paid
 */
class Deposits extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%deposits}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sum', 'user_id', 'currency', 'paid'], 'required'],
            [['sum', 'user_id'], 'integer'],
            [['currency'], 'string', 'max' => 5],
            [['paid'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'sum' => Yii::t('frontend', 'Sum'),
            'user_id' => Yii::t('frontend', 'User ID'),
            'currency' => Yii::t('frontend', 'Currency'),
            'paid' => Yii::t('frontend', 'Paid'),
        ];
    }

    /**
     * @inheritdoc
     * @return DepositsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DepositsQuery(get_called_class());
    }
}
