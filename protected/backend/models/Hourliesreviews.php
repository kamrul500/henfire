<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hourliesreviews".
 *
 * @property integer $id
 * @property integer $hourlie_id
 * @property integer $user_id
 * @property integer $freelancer_id
 * @property integer $rating
 * @property string $review
 */
class Hourliesreviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%hourliesreviews}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hourlie_id', 'user_id', 'freelancer_id', 'rating'], 'integer'],
            [['review'], 'required'],
            [['review', 'replies'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hourlie_id' => Yii::t('app', 'Hourlie ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'freelancer_id' => Yii::t('app', 'Freelancer ID'),
            'rating' => Yii::t('app', 'Rating'),
            'review' => Yii::t('app', 'Review'),
        ];
    }

    /**
     * @inheritdoc
     * @return HourliesreviewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HourliesreviewsQuery(get_called_class());
    }
}
