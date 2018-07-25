<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%job_category}}".
 *
 * @property integer $id
 * @property string $Category
 * @property string $SubCategory
 */
class JobCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%job_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Category', 'SubCategory'], 'required'],
            [['Category', 'SubCategory'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'Category' => Yii::t('app', 'Category'),
            'SubCategory' => Yii::t('app', 'Sub Category'),
        ];
    }

    /**
     * @inheritdoc
     * @return JobCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobCategoryQuery(get_called_class());
    }
}
