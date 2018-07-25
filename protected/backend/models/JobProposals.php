<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%job_proposals}}".
 *
 * @property integer $id
 * @property integer $job_id
 * @property integer $user_id
 * @property integer $price
 * @property string $delivery_time
 * @property string $comment
 * @property integer $accepted
 * @property integer $declined
 * @property string $date
 *
 * @property Job $job
 * @property User $user
 */
class JobProposals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%job_proposals}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_id', 'user_id', 'price', 'delivery_time', 'comment'], 'required'],
            [['job_id', 'user_id', 'price', 'accepted', 'declined'], 'integer'],
            [['comment'], 'string'],
            [['date'], 'safe'],
            [['delivery_time'], 'string', 'max' => 10],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Job::className(), 'targetAttribute' => ['job_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'job_id' => Yii::t('app', 'Job ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'price' => Yii::t('app', 'Price'),
            'delivery_time' => Yii::t('app', 'Delivery Time'),
            'comment' => Yii::t('app', 'Comment'),
            'accepted' => Yii::t('app', 'Accepted'),
            'declined' => Yii::t('app', 'Declined'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(Job::className(), ['id' => 'job_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return JobProposalsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobProposalsQuery(get_called_class());
    }
}
