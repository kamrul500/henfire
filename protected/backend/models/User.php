<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $paypal_email
 * @property string $unconfirmed_email
 * @property integer $status
 * @property integer $created_at
 * @property integer $confirmed_at
 * @property integer $updated_at
 * @property integer $blocked_at
 * @property string $registration_ip
 * @property integer $flags
 * @property integer $last_login_at
 * @property string $profile_picture
 * @property string $full_name
 * @property string $country
 * @property string $country_code
 * @property string $occupation
 * @property string $company_name
 * @property string $introduction
 * @property integer $hourlie_rate
 * @property string $town
 * @property string $city
 * @property string $skills
 * @property string $cover_photo
 * @property string $portfolio
 * @property string $website_url
 * @property string $phone
 * @property integer $available_now
 * @property string $facebook
 * @property string $linkedin
 * @property string $currency
 * @property double $rating
 * @property integer $is_freelancer
 * @property integer $storedfunds
 *
 * @property Hourlies[] $hourlies
 * @property Hourliesreviews[] $hourliesreviews
 * @property Hourliesreviews[] $hourliesreviews0
 * @property Hourliessales[] $hourliessales
 * @property Hourliessales[] $hourliessales0
 * @property Hourliessales[] $hourliessales1
 * @property Hourliessales[] $hourliessales2
 * @property JobProposals[] $jobProposals
 * @property JobQuestions[] $jobQuestions
 * @property Payments[] $payments
 * @property Profile $profile
 * @property SocialAccount[] $socialAccounts
 * @property Token[] $tokens
 * @property Userreviews[] $userreviews
 * @property Userreviews[] $userreviews0
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'updated_at'], 'required'],
            [['status', 'created_at', 'confirmed_at', 'updated_at', 'blocked_at', 'flags', 'last_login_at', 'hourlie_rate', 'available_now', 'is_freelancer', 'storedfunds'], 'integer'],
            [['introduction', 'skills', 'portfolio'], 'string'],
            [['rating'], 'number'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'unconfirmed_email', 'profile_picture', 'full_name', 'occupation', 'company_name', 'town', 'city', 'cover_photo', 'website_url'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['paypal_email', 'facebook', 'linkedin'], 'string', 'max' => 250],
            [['registration_ip'], 'string', 'max' => 45],
            [['country'], 'string', 'max' => 22],
            [['country_code'], 'string', 'max' => 20],
            [['phone'], 'string', 'max' => 150],
            [['currency'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'paypal_email' => Yii::t('app', 'Paypal Email'),
            'unconfirmed_email' => Yii::t('app', 'Unconfirmed Email'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'confirmed_at' => Yii::t('app', 'Confirmed At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'blocked_at' => Yii::t('app', 'Blocked At'),
            'registration_ip' => Yii::t('app', 'Registration Ip'),
            'flags' => Yii::t('app', 'Flags'),
            'last_login_at' => Yii::t('app', 'Last Login At'),
            'profile_picture' => Yii::t('app', 'Profile Picture'),
            'full_name' => Yii::t('app', 'Full Name'),
            'country' => Yii::t('app', 'Country'),
            'country_code' => Yii::t('app', 'Country Code'),
            'occupation' => Yii::t('app', 'Occupation'),
            'company_name' => Yii::t('app', 'Company Name'),
            'introduction' => Yii::t('app', 'Introduction'),
            'hourlie_rate' => Yii::t('app', 'Hourlie Rate'),
            'town' => Yii::t('app', 'Town'),
            'city' => Yii::t('app', 'City'),
            'skills' => Yii::t('app', 'Skills'),
            'cover_photo' => Yii::t('app', 'Cover Photo'),
            'portfolio' => Yii::t('app', 'Portfolio'),
            'website_url' => Yii::t('app', 'Website Url'),
            'phone' => Yii::t('app', 'Phone'),
            'available_now' => Yii::t('app', 'Available Now'),
            'facebook' => Yii::t('app', 'Facebook'),
            'linkedin' => Yii::t('app', 'Linkedin'),
            'currency' => Yii::t('app', 'Currency'),
            'rating' => Yii::t('app', 'Rating'),
            'is_freelancer' => Yii::t('app', 'Is Freelancer'),
            'storedfunds' => Yii::t('app', 'Storedfunds'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHourlies()
    {
        return $this->hasMany(Hourlies::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHourliesreviews()
    {
        return $this->hasMany(Hourliesreviews::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHourliesreviews0()
    {
        return $this->hasMany(Hourliesreviews::className(), ['freelancer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHourliessales()
    {
        return $this->hasMany(Hourliessales::className(), ['seller_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHourliessales0()
    {
        return $this->hasMany(Hourliessales::className(), ['buyer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHourliessales1()
    {
        return $this->hasMany(Hourliessales::className(), ['buyer_paypal' => 'paypal_email']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHourliessales2()
    {
        return $this->hasMany(Hourliessales::className(), ['seller_paypal' => 'paypal_email']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobProposals()
    {
        return $this->hasMany(JobProposals::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobQuestions()
    {
        return $this->hasMany(JobQuestions::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payments::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialAccounts()
    {
        return $this->hasMany(SocialAccount::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTokens()
    {
        return $this->hasMany(Token::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserreviews()
    {
        return $this->hasMany(Userreviews::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserreviews0()
    {
        return $this->hasMany(Userreviews::className(), ['reviewr_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
