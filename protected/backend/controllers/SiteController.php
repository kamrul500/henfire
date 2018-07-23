<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use app\models\Hourlies;
use app\models\Hourliessales;
use app\models\Job;
use app\models\User;
use common\components\MyHelpers;
use Symfony\Component\Intl\Intl;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */

    public function behaviors()
    {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
	public function actionIndex()
    {

      if(!Yii::$app->user->identity->isAdmin)
  		{
  			Yii::$app->user->logout();
  			 return $this->goHome();
  		}

      $hourlies = hourliessales::find()->limit(10)->orderBy(['id'=>SORT_DESC])->all();
      $Totalhourlies = hourlies::find()->count();
      $Totaljobs = Job::find()->where(['success' => '0'])->count();
      $TotalUsers = User::find()->where(['is_freelancer' => '0'])->count();
      $TotalFreelancers = User::find()->where(['is_freelancer' => '1'])->count();
      $curencySymbol = Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency());
      $currencycodelow = strtolower(MyHelpers::Currency());
      foreach ($hourlies as $sales)
      {
        $orderid = $sales['custom_trans_id'];
        $itemid = $sales['item_id'];
        $name = $sales['item_name'];
        $price = $sales['total_cost'];
        $paidstatus = $sales['paid_status'];
        $buyer = MyHelpers::IdToName($sales['buyer_id']);
        $seller = MyHelpers::IdToName($sales['seller_id']);
        $label = 'label-success';


        if($paidstatus == 'Pending')
        {
          $label = 'label-warning';
        }
        $string = preg_replace("/[^\w]+/", '-', $name);
        $SeoURL = strtolower($string);
        $latesthourliesales .= '
        <tr>
          <td>'.$orderid.'</td>
          <td>'.Html::a($name,Url::base(true).'/hourlies/'.$SeoURL.'-'.$itemid,['target'=>'_blank']).'</td>
          <td><span class="label '.$label.'">'.$paidstatus.'</span></td>
          <td>'.$curencySymbol . $price.'</td>
          <td>
            <div class="sparkbar" data-color="#00a65a" data-height="20">'.$buyer.'</div>
          </td>
        </tr>
        ';
      }

        	return $this->render('index', [
              'latesthourliesales' => $latesthourliesales,
              'curencySymbol' => $curencySymbol,
              'currencycodelow' => $currencycodelow,
              'Totalhourlies' => $Totalhourlies,
              'Totaljobs' => $Totaljobs,
              'TotalUsers' => $TotalUsers,
              'TotalFreelancers' => $TotalFreelancers,
          ]);


    }


    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
