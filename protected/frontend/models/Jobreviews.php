<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%jobreviews}}".
 *
 * @property integer $id
 * @property integer $job_id
 * @property integer $user_id
 * @property integer $freelancer_id
 * @property string $rating
 * @property string $review
 * @property string $date
 * @property string $replies
 */
class Jobreviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%jobreviews}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_id', 'user_id', 'freelancer_id'], 'integer'],
            [['review', 'replies'], 'string'],
            [['date'], 'safe'],
            [['rating'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'job_id' => Yii::t('frontend', 'Job ID'),
            'user_id' => Yii::t('frontend', 'User ID'),
            'freelancer_id' => Yii::t('frontend', 'Freelancer ID'),
            'rating' => Yii::t('frontend', 'Rating'),
            'review' => Yii::t('frontend', 'Review'),
            'date' => Yii::t('frontend', 'Date'),
            'replies' => Yii::t('frontend', 'Replies'),
        ];
    }

    /**
     * @inheritdoc
     * @return JobreviewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobreviewsQuery(get_called_class());
    }
}
