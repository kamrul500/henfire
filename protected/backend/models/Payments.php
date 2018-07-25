<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%payments}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $date
 * @property string $sum
 * @property integer $job_id
 * @property integer $hourlie_id
 * @property integer $withdrawn
 *
 * @property User $user
 * @property Hourlies $hourlie
 * @property Job $job
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%payments}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'sum'], 'required'],
            [['user_id', 'job_id', 'hourlie_id', 'withdrawn'], 'integer'],
            [['date'], 'safe'],
            [['sum'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['hourlie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hourlies::className(), 'targetAttribute' => ['hourlie_id' => 'id']],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Job::className(), 'targetAttribute' => ['job_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'user_id' => Yii::t('backend', 'User ID'),
            'date' => Yii::t('backend', 'Date'),
            'sum' => Yii::t('backend', 'Sum'),
            'job_id' => Yii::t('backend', 'Job ID'),
            'hourlie_id' => Yii::t('backend', 'Hourlie ID'),
            'withdrawn' => Yii::t('backend', 'Withdrawn'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHourlie()
    {
        return $this->hasOne(Hourlies::className(), ['id' => 'hourlie_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(Job::className(), ['id' => 'job_id']);
    }

    /**
     * @inheritdoc
     * @return PaymentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaymentsQuery(get_called_class());
    }
}
