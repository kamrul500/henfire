<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%settings}}".
 *
 * @property integer $id
 * @property string $sitename
 * @property string $email
 * @property string $logo
 * @property string $currency
 * @property string $facebook
 * @property string $twitter
 * @property string $google
 * @property string $commission
 * @property string $PayPalAuth
 * @property string $PayPalSecret
 * @property string $PayPalEnvironment
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $logonew;
    public static function tableName()
    {
        return '{{%settings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['logonew'], 'file'],
            [['sitename', 'email', 'currency'], 'required'],
            [['logo', 'site_seo_title', 'keywords'], 'string', 'max' => 255],
            [['sitename'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 150],
            [['facebook', 'twitter', 'google', 'PayPalAuth', 'PayPalSecret'], 'string', 'max' => 250],
            [['feature_hourlie_price', 'feature_job_price'], 'integer'],
            [['currency'], 'string', 'max' => 5],
            [['commission'], 'string', 'max' => 3],
            [['analytics'], 'string'],
            [['PayPalEnvironment'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'sitename' => Yii::t('backend', 'Sitename'),
			      'site_seo_title' => Yii::t('backend', 'Site Description'),
			      'keywords' => Yii::t('backend', 'Keywords (comma seperates)'),
            'email' => Yii::t('backend', 'Email'),
            'logonew' => Yii::t('backend', 'Logo'),
            'currency' => Yii::t('backend', 'Currency code (for example GBP)'),
            'facebook' => Yii::t('backend', 'Facebook'),
            'twitter' => Yii::t('backend', 'Twitter'),
            'google' => Yii::t('backend', 'Google'),
            'feature_hourlie_price' => Yii::t('backend', 'Feature Houlie Price'),
            'feature_job_price' => Yii::t('backend', 'Feature Job Price'),
            'commission' => Yii::t('backend', 'Commission'),
            'PayPalAuth' => Yii::t('backend', 'Pay Pal Auth'),
            'PayPalSecret' => Yii::t('backend', 'Pay Pal Secret'),
            'PayPalEnvironment' => Yii::t('backend', 'Pay Pal Environment (sandbox or live)'),
        ];
    }
}
