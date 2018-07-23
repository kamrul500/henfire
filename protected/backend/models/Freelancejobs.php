<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "freelancejobs".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property string $video
 * @property string $date_created
 * @property string $date_expire
 * @property integer $cost
 * @property integer $promoted
 * @property integer $paid
 * @property integer $success
 */
class Freelancejobs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%freelancejobs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'title', 'description', 'video', 'date_created', 'date_expire', 'cost', 'promoted', 'paid', 'success'], 'required'],
            [['id', 'user_id', 'cost', 'promoted', 'paid', 'success'], 'integer'],
            [['date_created', 'date_expire'], 'safe'],
            [['title'], 'string', 'max' => 250],
            [['description'], 'string', 'max' => 500],
            [['video'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'video' => Yii::t('app', 'Video'),
            'date_created' => Yii::t('app', 'Date Created'),
            'date_expire' => Yii::t('app', 'Date Expire'),
            'cost' => Yii::t('app', 'Cost'),
            'promoted' => Yii::t('app', 'Promoted'),
            'paid' => Yii::t('app', 'Paid'),
            'success' => Yii::t('app', 'Success'),
        ];
    }

    /**
     * @inheritdoc
     * @return FreelancejobsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FreelancejobsQuery(get_called_class());
    }
}
