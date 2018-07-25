<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "job_proposals".
 *
 * @property int $id
 * @property int $job_id
 * @property int $user_id
 * @property int $price
 * @property string $delivery_time
 * @property string $comment
 * @property int $accepted
 */
class JobProposals extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%job_proposals}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'user_id', 'price', 'delivery_time', 'comment'], 'required'],
            [['job_id', 'user_id', 'price', 'accepted'], 'integer'],
            [['comment'], 'string'],
            [['delivery_time'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'job_id' => Yii::t('frontend', 'Job ID'),
            'user_id' => Yii::t('frontend', 'User ID'),
            'price' => Yii::t('frontend', 'Price'),
            'delivery_time' => Yii::t('frontend', 'Delivery Time'),
            'comment' => Yii::t('frontend', 'Comment'),
            'accepted' => Yii::t('frontend', 'Accepted'),
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @return JobProposalsQuery the active query used by this AR class
     */
    public static function find()
    {
        return new JobProposalsQuery(get_called_class());
    }
}
