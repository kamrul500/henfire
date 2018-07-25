<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "apps_countries".
 *
 * @property int $id
 * @property string $country_code
 * @property string $country_name
 */
class AppsCountries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%apps_countries}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_code'], 'string', 'max' => 2],
            [['country_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'country_code' => Yii::t('frontend', 'Country Code'),
            'country_name' => Yii::t('frontend', 'Country Name'),
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @return AppsCountriesQuery the active query used by this AR class
     */
    public static function find()
    {
        return new AppsCountriesQuery(get_called_class());
    }
}
