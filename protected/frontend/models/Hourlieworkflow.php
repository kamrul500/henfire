<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%hourlieworkflow}}".
 *
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
            [['workstream', 'user_id', 'comment', 'flagged_comment'], 'required'],
            [['workstream', 'user_id', 'flagged', 'flagged_comment'], 'integer'],
            [['comment'], 'string'],
            [['date'], 'safe'],
            [['upload'], 'file'],
            [['workstream'], 'exist', 'skipOnError' => true, 'targetClass' => Hourlieworkstream::className(), 'targetAttribute' => ['workstream' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'workstream' => Yii::t('frontend', 'Workstream'),
            'user_id' => Yii::t('frontend', 'User ID'),
            'comment' => Yii::t('frontend', 'Comment'),
            'upload' => Yii::t('frontend', 'Upload zip file'),
            'date' => Yii::t('frontend', 'Date'),
            'flagged' => Yii::t('frontend', 'Flagged'),
            'flagged_comment' => Yii::t('frontend', 'Flagged Comment'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkstream0()
    {
        return $this->hasOne(Hourlieworkstream::className(), ['id' => 'workstream']);
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
