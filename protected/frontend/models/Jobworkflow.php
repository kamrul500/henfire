<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%jobworkflow}}".
 *
 * @property integer $workstream
 * @property integer $user_id
 * @property string $comment
 * @property string $upload
 * @property string $date
 * @property integer $flagged
 * @property integer $flagged_comment
 *
 * @property Jobworkstream $workstream0
 */
class Jobworkflow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%jobworkflow}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workstream', 'user_id', 'comment'], 'required'],
            [['workstream', 'user_id', 'flagged', 'flagged_comment'], 'integer'],
            [['comment'], 'string'],
            [['date'], 'safe'],
            [['upload'], 'string', 'max' => 250],
            [['workstream'], 'exist', 'skipOnError' => true, 'targetClass' => Jobworkstream::className(), 'targetAttribute' => ['workstream' => 'id']],
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
            'upload' => Yii::t('frontend', 'Upload'),
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
        return $this->hasOne(Jobworkstream::className(), ['id' => 'workstream']);
    }

    /**
     * @inheritdoc
     * @return JobworkflowQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobworkflowQuery(get_called_class());
    }
}
