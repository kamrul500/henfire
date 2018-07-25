<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "job".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $category
 * @property string $subCat
 * @property string $date_created
 * @property string $date_expire
 * @property string $material
 * @property int $promoted
 * @property int $paid
 * @property int $success
 * @property string $worktype
 * @property string $currency
 * @property string $budget
 * @property int $experience_level
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $mymaterial;
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
            [['mymaterial'], 'file', 'skipOnEmpty' => true, 'maxFiles' => 14],
            [['user_id', 'title', 'description', 'subCat', 'date_created', 'date_expire'], 'required'],
            [['user_id', 'promoted', 'paid', 'success', 'experience_level','freelancer_paid', 'is_refunded'], 'integer'],
            [['description', 'material'], 'string'],
            [['date_created', 'date_expire'], 'safe'],
            [['title', 'budget'], 'string', 'max' => 100],
            [['category', 'subCat'], 'string', 'max' => 250],
            [['worktype', 'currency'], 'string', 'max' => 22],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'user_id' => Yii::t('frontend', 'User ID'),
            'title' => Yii::t('frontend', 'Title'),
            'description' => Yii::t('frontend', 'Description'),
            'category' => Yii::t('frontend', 'Category'),
            'subCat' => Yii::t('frontend', 'Sub Cat'),
            'date_created' => Yii::t('frontend', 'Date Created'),
            'date_expire' => Yii::t('frontend', 'Need before?'),
            'material' => Yii::t('frontend', 'Material'),
            'promoted' => Yii::t('frontend', 'Promoted'),
            'paid' => Yii::t('frontend', 'Paid'),
            'success' => Yii::t('frontend', 'Success'),
            'worktype' => Yii::t('frontend', 'Worktype'),
            'currency' => Yii::t('frontend', 'Currency'),
            'budget' => Yii::t('frontend', 'Budget (Optional)'),
            'experience_level' => Yii::t('frontend', 'Experience Level'),
            'mymaterial' => Yii::t('frontend', 'Upload Material'),
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @return JobQuery the active query used by this AR class
     */
    public static function find()
    {
        return new JobQuery(get_called_class());
    }

    public static function getSub($category_id)
    {
        $data = \app\models\JobCategory::find()
       ->where(['Category' => $category_id])
       ->select(['SubCategory As name', 'SubCategory AS id'])->asArray()->all();

        return $data;
    }
}
