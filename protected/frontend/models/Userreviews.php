<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%userreviews}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $reviewr_id
 * @property string $review
 *
 * @property User $user
 * @property User $reviewr
 */
class Userreviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%userreviews}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'reviewr_id', 'review'], 'required'],
            [['user_id', 'reviewr_id', 'rating'], 'integer'],
            [['review'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['reviewr_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['reviewr_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'user_id' => Yii::t('frontend', 'User ID'),
            'reviewr_id' => Yii::t('frontend', 'Reviewr ID'),
            'review' => Yii::t('frontend', 'Review'),
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
    public function getReviewr()
    {
        return $this->hasOne(User::className(), ['id' => 'reviewr_id']);
    }

    /**
     * @inheritdoc
     * @return UserreviewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserreviewsQuery(get_called_class());
    }
}
