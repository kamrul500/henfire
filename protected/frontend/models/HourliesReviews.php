<?php

namespace app\models;

/**
 * This is the model class for table "hourliesreviews".
 *
 * @property int $id
 * @property int $hourlie_id
 * @property int $user_id
 * @property int $freelancer_id
 * @property int $rating
 * @property string $review
 */
class HourliesReviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%hourliesreviews}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hourlie_id', 'user_id', 'freelancer_id'], 'integer'],
            [['review'], 'required'],
            [['review','rating' ], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hourlie_id' => 'Hourlie ID',
            'user_id' => 'User ID',
            'freelancer_id' => 'Freelancer ID',
            'rating' => 'Rating',
            'review' => 'Review',
        ];
    }
}
