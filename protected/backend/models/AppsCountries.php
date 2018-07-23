<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%apps_countries}}".
 *
 * @property integer $id
 * @property string $country_code
 * @property string $country_name
 * @property integer $display
 */
class AppsCountries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%apps_countries}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['display'], 'integer'],
            [['country_code'], 'string', 'max' => 2],
            [['country_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'country_code' => Yii::t('app', 'Country Code'),
            'country_name' => Yii::t('app', 'Country Name'),
            'display' => Yii::t('app', 'Display'),
        ];
    }

    /**
     * @inheritdoc
     * @return AppsCountriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppsCountriesQuery(get_called_class());
    }
}
