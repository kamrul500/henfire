<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%job_questions}}".
 *
 * @property integer $id
 * @property integer $job_id
 * @property integer $user_id
 * @property string $question
 * @property string $answer
 * @property string $request_date
 * @property string $answer_date
 *
 * @property Job $job
 * @property User $user
 */
class JobQuestions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%job_questions}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_id', 'user_id', 'question'], 'required'],
            [['job_id', 'user_id'], 'integer'],
            [['request_date', 'answer_date'], 'safe'],
            [['question', 'answer'], 'string', 'max' => 500],
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
            'question' => Yii::t('app', 'Question'),
            'answer' => Yii::t('app', 'Answer'),
            'request_date' => Yii::t('app', 'Request Date'),
            'answer_date' => Yii::t('app', 'Answer Date'),
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
     * @return JobQuestionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobQuestionsQuery(get_called_class());
    }
}
