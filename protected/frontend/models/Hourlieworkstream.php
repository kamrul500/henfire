<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%hourlieworkstream}}".
 *
 * @property integer $job_id
 * @property integer $freelancer_id
 * @property integer $user_id
 * @property integer $is_finished
 * @property integer $admin_flagged
 * @property integer $freelancer_flagged
 * @property integer $member_flagged
 * @property string $flagged_comment
 */
class Hourlieworkstream extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%hourlieworkstream}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['job_id', 'freelancer_id', 'user_id'], 'required'],
            [['job_id', 'freelancer_id', 'user_id', 'is_finished', 'admin_flagged', 'freelancer_flagged', 'member_flagged'], 'integer'],
            [['flagged_comment', 'date'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'job_id' => Yii::t('frontend', 'Job ID'),
            'freelancer_id' => Yii::t('frontend', 'Freelancer ID'),
            'user_id' => Yii::t('frontend', 'User ID'),
            'is_finished' => Yii::t('frontend', 'Is Finished'),
            'admin_flagged' => Yii::t('frontend', 'Admin Flagged'),
            'freelancer_flagged' => Yii::t('frontend', 'Freelancer Flagged'),
            'member_flagged' => Yii::t('frontend', 'Member Flagged'),
            'flagged_comment' => Yii::t('frontend', 'Flagged Comment'),
            'date' => Yii::t('frontend', 'Date'),
        ];
    }

    /**
     * @inheritdoc
     * @return HourlieworkstreamQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HourlieworkstreamQuery(get_called_class());
    }
}
