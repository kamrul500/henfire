<?php

namespace app\models;

/**
 * This is the model class for table "job".
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
class FreelanceJobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%job}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'description', 'video', 'date_expire', 'subCat', 'cost'], 'required'],
            [['user_id', 'cost', 'category_id'], 'integer'],
            [['date_created', 'date_expire'], 'safe'],
            [['title'], 'string', 'max' => 250],
            [['description'], 'string', 'max' => 500],
            [['video'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [

            'user_id' => 'User ID',
            'title' => 'WHAT DO YOU NEED TO GET DONE?',
            'description' => 'Description',
            'video' => 'Video URL',
            'date_created' => 'Date Created',
            'date_expire' => 'Date Expire',
            'cost' => 'Cost',

        ];
    }
}
