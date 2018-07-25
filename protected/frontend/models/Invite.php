<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%invite}}".
 *
 * @property integer $id
 * @property integer $user
 * @property integer $frelancer
 * @property string $date
 * @property integer $job_id
 * @property string $message
 */
class Invite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%invite}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'frelancer', 'job_id'], 'required'],
            [['user', 'frelancer', 'job_id'], 'integer'],
            [['message'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user' => Yii::t('app', 'User'),
            'frelancer' => Yii::t('app', 'Frelancer'),
            'date' => Yii::t('app', 'Date'),
            'job_id' => Yii::t('app', 'Job ID'),
            'message' => Yii::t('app', 'Message'),
        ];
    }

    /**
     * @inheritdoc
     * @return InviteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InviteQuery(get_called_class());
    }
}
