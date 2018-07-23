<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "job_category".
 *
 * @property string $Category
 * @property string $SubCategory
 */
class JobCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%job_category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Category', 'SubCategory'], 'required'],
            [['Category', 'SubCategory'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Category' => Yii::t('frontend', 'Category'),
            'SubCategory' => Yii::t('frontend', 'Sub Category'),
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @return JobCategoryQuery the active query used by this AR class
     */
    public static function find()
    {
        return new JobCategoryQuery(get_called_class());
    }
}
