<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hourlies".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property string $video
 * @property string $video_image
 * @property string $images
 * @property string $date_created
 * @property string $date_expire
 * @property integer $delivery_time
 * @property integer $cost
 * @property integer $promoted
 * @property integer $paid
 * @property integer $success
 * @property integer $views
 * @property integer $sales
 * @property string $country_code
 */
class Hourlies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $image;
    public static function tableName()
    {
        return '{{%hourlies}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'title', 'description', 'needed',  ], 'required'],
            [['user_id', 'delivery_time', 'cost', 'promoted', 'dissabled', 'paid', 'success', 'views', 'sales'], 'integer'],
            [['description', 'images', 'needed', 'category', 'subCat'], 'string'],
            [['date_created'], 'safe'],
            [['title'], 'string', 'max' => 250],
            [['video'], 'string', 'max' => 150],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions' => 'jpg, gif, png', 'maxFiles' => 6],
            [['country_code'], 'string', 'max' => 10],
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
            'images' => Yii::t('app', 'Images'),
            'date_created' => Yii::t('app', 'Date Created'),
            'delivery_time' => Yii::t('app', 'Delivery Time'),
            'cost' => Yii::t('app', 'Cost'),
            'promoted' => Yii::t('app', 'Promoted'),
            'paid' => Yii::t('app', 'Paid'),
            'success' => Yii::t('app', 'Success'),
            'views' => Yii::t('app', 'Views'),
            'sales' => Yii::t('app', 'Sales'),
            'country_code' => Yii::t('app', 'Country Code'),
        ];
    }
}
