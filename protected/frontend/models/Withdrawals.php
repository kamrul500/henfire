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
class Withdrawals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%withdrawals}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sum', 'user_id'], 'required'],
            [['sum', 'user_id'], 'integer'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sum' => Yii::t('frontend', 'Sum'),
            'user_id' => Yii::t('frontend', 'User ID'),

        ];
    }

    /**
     * @inheritdoc
     * @return WithdrawalsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WithdrawalsQuery(get_called_class());
    }
}
