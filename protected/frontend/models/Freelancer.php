<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "freelancer".
 *
 * @property int $id
 * @property int $user_id
 * @property string $username
 * @property string $full_name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Freelancer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%freelancer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'username', 'full_name', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username'], 'string', 'max' => 255],
            [['full_name'], 'string', 'max' => 150],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'user_id' => Yii::t('frontend', 'User ID'),
            'username' => Yii::t('frontend', 'Username'),
            'full_name' => Yii::t('frontend', 'Full Name'),
            'status' => Yii::t('frontend', 'Status'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @return FreelancerQuery the active query used by this AR class
     */
    public static function find()
    {
        return new FreelancerQuery(get_called_class());
    }
}
