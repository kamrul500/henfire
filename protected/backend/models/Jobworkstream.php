<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%jobworkstream}}".
 *
 * @property integer $job_id
 * @property integer $freelancer_id
 * @property integer $user_id
 * @property integer $is_finished
 * @property integer $admin_flagged
 * @property integer $freelancer_flagged
 * @property integer $member_flagged
 * @property string $flagged_comment
 *
 * @property Jobworkflow[] $jobworkflows
 */
class Jobworkstream extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%jobworkstream}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_id', 'freelancer_id', 'user_id'], 'required'],
            [['job_id', 'freelancer_id', 'user_id', 'is_finished', 'admin_flagged', 'freelancer_flagged', 'member_flagged'], 'integer'],
            [['flagged_comment'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'job_id' => Yii::t('app', 'Job ID'),
            'freelancer_id' => Yii::t('app', 'Freelancer ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'is_finished' => Yii::t('app', 'Is Finished'),
            'admin_flagged' => Yii::t('app', 'Admin Flagged'),
            'freelancer_flagged' => Yii::t('app', 'Freelancer Flagged'),
            'member_flagged' => Yii::t('app', 'Member Flagged'),
            'flagged_comment' => Yii::t('app', 'Flagged Comment'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobworkflows()
    {
        return $this->hasMany(Jobworkflow::className(), ['workstream' => 'job_id']);
    }

    /**
     * @inheritdoc
     * @return JobworkstreamQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobworkstreamQuery(get_called_class());
    }
}
