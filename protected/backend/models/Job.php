<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%job}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property string $category
 * @property string $subCat
 * @property string $date_created
 * @property string $date_expire
 * @property string $material
 * @property integer $promoted
 * @property integer $paid
 * @property integer $success
 * @property integer $isEscro
 * @property integer $released_escro
 * @property integer $freelancer
 * @property string $freelancer_paypal
 * @property integer $buyer_cancelled
 * @property integer $seller_cancelled
 * @property integer $date_completed
 * @property string $worktype
 * @property string $currency
 * @property string $budget
 * @property integer $agreed_price
 * @property integer $experience_level
 * @property string $buyer_transaction_code
 * @property string $payment_type
 * @property string $buyer_paypal
 * @property string $buyer_paypal_auth
 * @property string $seller_paypal
 * @property string $buyer_card_vault
 * @property integer $complaint
 * @property string $complaint_message
 * @property string $custom_trans_id
 * @property string $our_commission
 * @property string $totalaftercommission
 * @property string $sellers_currency
 * @property string $buyers_currency
 * @property integer $origional_currency_price
 *
 * @property JobProposals[] $jobProposals
 * @property JobQuestions[] $jobQuestions
 * @property Payments[] $payments
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%job}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'subCat', 'date_created'], 'required'],
            [['user_id', 'promoted', 'paid', 'success', 'isEscro', 'released_escro', 'freelancer', 'buyer_cancelled', 'seller_cancelled', 'date_completed', 'agreed_price', 'experience_level', 'complaint', 'origional_currency_price'], 'integer'],
            [['description', 'material', 'complaint_message'], 'string'],
            [['date_created'], 'safe'],
            [['title', 'budget'], 'string', 'max' => 100],
            [['category', 'subCat', 'buyer_transaction_code', 'buyer_paypal_auth', 'buyer_card_vault', 'custom_trans_id'], 'string', 'max' => 250],
            [['date_expire', 'worktype', 'currency'], 'string', 'max' => 22],
            [['freelancer_paypal'], 'string', 'max' => 120],
            [['payment_type'], 'string', 'max' => 50],
            [['buyer_paypal', 'seller_paypal', 'our_commission', 'totalaftercommission'], 'string', 'max' => 150],
            [['sellers_currency'], 'string', 'max' => 5],
            [['buyers_currency'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'category' => Yii::t('app', 'Category'),
            'subCat' => Yii::t('app', 'Sub Cat'),
            'date_created' => Yii::t('app', 'Date Created'),
            'date_expire' => Yii::t('app', 'Date Expire'),
            'material' => Yii::t('app', 'Material'),
            'promoted' => Yii::t('app', 'Promoted'),
            'paid' => Yii::t('app', 'Paid'),
            'success' => Yii::t('app', 'Success'),
            'isEscro' => Yii::t('app', 'Is Escro'),
            'released_escro' => Yii::t('app', 'Released Escro'),
            'freelancer' => Yii::t('app', 'Freelancer'),
            'freelancer_paypal' => Yii::t('app', 'Freelancer Paypal'),
            'buyer_cancelled' => Yii::t('app', 'Buyer Cancelled'),
            'seller_cancelled' => Yii::t('app', 'Seller Cancelled'),
            'date_completed' => Yii::t('app', 'Date Completed'),
            'worktype' => Yii::t('app', 'Worktype'),
            'currency' => Yii::t('app', 'Currency'),
            'budget' => Yii::t('app', 'Budget'),
            'agreed_price' => Yii::t('app', 'Agreed Price'),
            'experience_level' => Yii::t('app', 'Experience Level'),
            'buyer_transaction_code' => Yii::t('app', 'Buyer Transaction Code'),
            'payment_type' => Yii::t('app', 'Payment Type'),
            'buyer_paypal' => Yii::t('app', 'Buyer Paypal'),
            'buyer_paypal_auth' => Yii::t('app', 'Buyer Paypal Auth'),
            'seller_paypal' => Yii::t('app', 'Seller Paypal'),
            'buyer_card_vault' => Yii::t('app', 'Buyer Card Vault'),
            'complaint' => Yii::t('app', 'Complaint'),
            'complaint_message' => Yii::t('app', 'Complaint Message'),
            'custom_trans_id' => Yii::t('app', 'Custom Trans ID'),
            'our_commission' => Yii::t('app', 'Our Commission'),
            'totalaftercommission' => Yii::t('app', 'Totalaftercommission'),
            'sellers_currency' => Yii::t('app', 'Sellers Currency'),
            'buyers_currency' => Yii::t('app', 'Buyers Currency'),
            'origional_currency_price' => Yii::t('app', 'Origional Currency Price'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobProposals()
    {
        return $this->hasMany(JobProposals::className(), ['job_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobQuestions()
    {
        return $this->hasMany(JobQuestions::className(), ['job_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payments::className(), ['job_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return JobQuery the active query used by this AR class.
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
