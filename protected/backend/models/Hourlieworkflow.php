<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%hourlieworkflow}}".
 *
 * @property integer $id
 * @property integer $workstream
 * @property integer $user_id
 * @property string $comment
 * @property string $upload
 * @property string $date
 * @property integer $flagged
 * @property integer $flagged_comment
 *
 * @property Hourlieworkstream $workstream0
 */
class Hourlieworkflow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%hourlieworkflow}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workstream', 'user_id', 'comment', 'upload', 'flagged_comment'], 'required'],
            [['workstream', 'user_id', 'flagged', 'flagged_comment'], 'integer'],
            [['comment'], 'string'],
            [['date'], 'safe'],
            [['upload'], 'string', 'max' => 250],
            [['workstream'], 'exist', 'skipOnError' => true, 'targetClass' => Hourlieworkstream::className(), 'targetAttribute' => ['workstream' => 'job_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'workstream' => Yii::t('app', 'Workstream'),
            'user_id' => Yii::t('app', 'User ID'),
            'comment' => Yii::t('app', 'Comment'),
            'upload' => Yii::t('app', 'Upload'),
            'date' => Yii::t('app', 'Date'),
            'flagged' => Yii::t('app', 'Flagged'),
            'flagged_comment' => Yii::t('app', 'Flagged Comment'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkstream0()
    {
        return $this->hasOne(Hourlieworkstream::className(), ['job_id' => 'workstream']);
    }

    /**
     * @inheritdoc
     * @return HourlieworkflowQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HourlieworkflowQuery(get_called_class());
    }
}
