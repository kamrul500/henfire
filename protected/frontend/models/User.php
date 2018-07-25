<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $profile_picture
 * @property string $full_name
 * @property string $country
 * @property string $occupation
 * @property string $company_name
 * @property string $introduction
 * @property int $hourlie_rate
 * @property string $town
 * @property string $city
 * @property string $skills
 * @property string $cover_photo
 * @property string $portfolio
 * @property string $website_url
 * @property string $phone
 * @property int $available_now
 * @property string $facebook
 * @property string $linkedin
 * @property string $currency
 */
class User extends \yii\db\ActiveRecord
{
    /**
      * {@inheritdoc}
      */
    public $file;
    public $imageFile;
    public $uploadPortfolio;
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file'], 'file'],
            [['imageFile'], 'file'],
            [['uploadPortfolio'], 'file', 'skipOnEmpty' => true, 'maxFiles' => 14],
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at', 'hourlie_rate', 'available_now'], 'integer'],
            [['introduction', 'skills', 'portfolio'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'paypal_email', 'profile_picture', 'full_name', 'occupation', 'company_name', 'town', 'city', 'website_url'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['country'], 'string', 'max' => 22],
            [['phone'], 'string', 'max' => 150],
            [['facebook', 'linkedin'], 'string', 'max' => 250],
            [['currency'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'username' => Yii::t('frontend', 'Username'),
            'auth_key' => Yii::t('frontend', 'Auth Key'),
            'password_hash' => Yii::t('frontend', 'Password Hash'),
            'password_reset_token' => Yii::t('frontend', 'Password Reset Token'),
            'email' => Yii::t('frontend', 'Email'),
            'status' => Yii::t('frontend', 'Status'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
            'profile_picture' => Yii::t('frontend', 'Profile Picture'),
            'full_name' => Yii::t('frontend', 'Full Name'),
            'country' => Yii::t('frontend', 'Country'),
            'occupation' => Yii::t('frontend', 'JOB TITLE'),
            'company_name' => Yii::t('frontend', 'Company Name'),
            'introduction' => Yii::t('frontend', 'Introduction'),
            'hourlie_rate' => Yii::t('frontend', 'Hourlie Rate'),
            'town' => Yii::t('frontend', 'Town'),
            'city' => Yii::t('frontend', 'City'),
            'skills' => Yii::t('frontend', 'Skills'),
            'cover_photo' => Yii::t('frontend', 'Cover Photo'),
            'portfolio' => Yii::t('frontend', 'Portfolio'),
            'website_url' => Yii::t('frontend', 'Website Url'),
            'phone' => Yii::t('frontend', 'Phone'),
            'available_now' => Yii::t('frontend', 'Available Now'),
            'facebook' => Yii::t('frontend', 'Facebook'),
            'linkedin' => Yii::t('frontend', 'Linkedin'),
            'currency' => Yii::t('frontend', 'Currency'),
            'file' => Yii::t('frontend', 'Profile Picture'),
            'imageFile' => Yii::t('frontend', 'Cover Photo'),
            'uploadPortfolio' => Yii::t('frontend', 'Upload Portfolio'),
        ];
    }
}
