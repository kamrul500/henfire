<?php

namespace app\models;

/**
 * This is the model class for table "hourlies".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $video
 * @property string $date_created
 * @property string $date_expire
 * @property int $cost
 * @property int $promoted
 * @property int $paid
 * @property int $success
 */
class Hourlies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $image;
    public static function tableName()
    {
        return '{{%hourlies}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'delivery_time', 'description', 'country_code', 'category', 'subCat', 'date_created', 'cost'], 'required'],
            [['user_id', 'cost', 'delivery_time', 'promoted', 'promoted_term'], 'integer'],
            [['date_created'], 'safe'],
            [['title', 'promoted_paypal_auth'], 'string', 'max' => 250],
            [['description', 'needed'], 'string', 'max' => 1500],
            [['video'], 'string', 'max' => 150],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions' => 'jpg, gif, png', 'maxFiles' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [

            'title' => 'What can you offer today?',
            'description' => 'Describe in detail what you are able to offer',
            'video' => 'Add a video for greater exposure (YouTube / Vimeo)',
            'date_created' => 'Date Created',
            'cost' => 'For',
            'promoted' => 'Promoted',
            'paid' => 'Paid',
            'success' => 'Success',
            'delivery_time' => 'When you can deliver?',
            'SubCat' => 'Sub Category',
            'image' => 'Add some pictures, make it fun!',
            'needed' => 'What do you need to get this job done?',
        ];
    }
}
