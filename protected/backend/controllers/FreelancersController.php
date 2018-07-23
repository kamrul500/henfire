<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Html;
use app\models\User;
use app\models\Hourlies;
use app\models\Job;
use app\models\JobProposals;
use yii\helpers\Url;
use app\models\Hourliessales;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Symfony\Component\Intl\Intl;
use yii\filters\VerbFilter;
use common\components\MyHelpers;

/**
 * FreelancerController implements the CRUD actions for Freelancer model.
 */
class FreelancersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Freelancer models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
      $model = new User();
      $freelancers = User::find()->where(['is_freelancer'=>'1'])->all();
      foreach($freelancers as $user)
      {

        $username = $user['username'];
        $full_name = $user['full_name'];
        $date_registered = $user['created_at'];
        $ip = $user['registration_ip'];
        $hourlie_rate = $user['hourlie_rate'];
        $country = $user['country'];
        $city = $user['city'];



        $table .= '
        <tr>
          <td>'.$username.'</a></td>
          <td>'.$full_name.'</td>
          <td>'.date('d/m/Y H:i:s', $date_registered).'</td>
          <td>'.$ip.'</td>
          <td>'.Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()).' '.$hourlie_rate.'</td>
          <td>'.$country.'</td>
          <td><a href="freelancers/view?id='.$user['id'].'">
            <i class="fa fa-eye" aria-hidden="true"></i>
          </a></td>

        </tr>';
      }
        return $this->render('@app/views/freelancers/index', [
            'table' => $table,
        ]);
    }

    /**
     * Displays a single Freelancer model.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
      $model = $this->findModel($id);
        $Hourlies_Bought = Hourliessales::find()->where(['buyer_id'=>$model->id])->all();
        foreach($Hourlies_Bought as $key)
        {
          $paidstatus = $key['paid_status'];
          $completeStatus = $key['completed'];

          if($completeStatus == 1)
          {
            $statuslabel = 'label-success';
            $status = Yii::t('backend', 'Completed');
          }
          else {
            $statuslabel = 'label-warning';
            $status = Yii::t('backend', 'In Progress');
          }
          $label = 'label-success';
          $workflow = '<a href="hourlieworkstream/view?id='.$id.'">
            <i class="fa fa-pencil" aria-hidden="true"></i>
          </a>';
          if($paidstatus == 'Pending')
          {
            $label = 'label-danger';
            $workflow = '<span class="label label-danger">'.Yii::t('backend', 'Pending Payment').'</span>';
          }
          $myboughthourlies .= '
          <tr>
            <td>'.$key['item_name'].'</a></td>
            <td>'.$key['cost'].'</td>
            <td>'.$key['amount_bought'].'</td>
            <td>'.Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()).' '.$key['total_cost'].'</td>
            <td><span class="label '.$label.'">'.$paidstatus.'</span></td>
            <td><span class="label '.$statuslabel.'">'.$status.'</span></td>
          </tr>';

        }

          $Jobs_created = Job::find()->where(['user_id'=>$model->id])->all();
          foreach($Jobs_created as $job)
          {
            $id = $job['id'];
            $title = $job['title'];
            $user = $job['user_id'];
            $category = $job['category'];
            $date_created = $job['date_created'];
            $date_expire = $job['date_expire'];
            $budget = $job['budget'];
            $promoted = $job['promoted'];
            $paid = $job['paid'];
            $completed = $job['success'];
            $freelancer = $job['freelancer'];
            $isEscro = $job['isEscro'];
            $freelancer_paid = $job['freelancer_paid'];
            $released_escro = $job['released_escro'];
            $buyer_cancelled = $job['buyer_cancelled'];
            $seller_cancelled = $job['seller_cancelled'];
            $user = $job['user_id'];
            if($paid == 0)
            {
              $status = '<small class="label bg-red">'.Yii::t('backend', 'Pending Payment').'</small>';
              $view = '';
            }
            elseif($paid == 1)
            {
              $status = '<small class="label bg-yellow">'.Yii::t('backend', 'In Progress').'</small>';
              $view = '<a href="../jobworkstream/view?id='.$id.'">
                <i class="fa fa-eye" aria-hidden="true"></i>
              </a>';
            }
            if($completed == 1)
            {
              $status = '<small class="label bg-green">'.Yii::t('backend', 'Completed').'</small>';
              $view = '<a href="../jobworkstream/view?id='.$id.'">
                <i class="fa fa-eye" aria-hidden="true"></i>
              </a>';
            }
            if($freelancer_paid == 1)
            {
              $status = '<small class="label bg-blue">'.Yii::t('backend', 'Frelncer paid').'</small>';
              $view = '<a href="../jobworkstream/view?id='.$id.'">
                <i class="fa fa-eye" aria-hidden="true"></i>
              </a>';
            }

            $ispromoted = 'No';
            if($promoted == 1)
            {
              $ispromoted = 'Prmoted';
            }

            $isinescro = 'No';
            if($isEscro == 1)
            {
              $isinescro = 'Yes';
            }

            $issues = 'No';
            if($buyer_cancelled == 1 || $seller_cancelled == 1)
            {
              $issues = 'yes';
            }
            $myjobs .= '
            <tr>
              <td>'.$title.'</td>
              <td>'.$status.'</td>
              <td>'.MyHelpers::IdToName($user).'</td>
              <td>'.MyHelpers::IdToName($freelancer).'</td>
              <td>'.Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()).' '.$budget.'</td>
              <td>'.$category.'</td>
              <td>'.$date_created.'</td>
              <td>'.$date_expire.'</td>
              <td>'.$ispromoted.'</td>
              <td>'.$isinescro.'</td>
              <td>'.$issues.'</td>
              <td>'.$view.'</td>

            </tr>
            ';
          }

          $Hourlies_Created = Hourlies::find()->where(['user_id'=>$model->id])->all();
          foreach($Hourlies_Created as $hourlie)
          {
            $id = $hourlie['id'];
            $category = $hourlie['category'];
            $title = $hourlie['title'];
            $userid = $hourlie['user_id'];
            $price = $hourlie['cost'];
            $date = $hourlie['date_created'];
            $promoted = $hourlie['promoted'];
            $dissabled = $hourlie['dissabled'];
            $activestate = '';
            if($dissabled == 1)
            {
              $activestate = '<small class="label bg-black-active color-palette">Dissabled</small>';
            }
            $promotedstate ='';
            if($promoted == 1)
            {
              $promotedstate = '<small class="label bg-green">Prmoted</small>';
            }

            $string = preg_replace("/[^\w]+/", '-', $title);
            $SeoURL = strtolower($string);
            $delete = Html::a('', 'hourlies/delete?id='.$id,
              [
               'data' => [
                       'method' => 'post',
                         // use it if you want to confirm the action
                       'confirm' => 'Are you sure?',
                       ],
              'class' => 'glyphicon glyphicon-trash btn btn-default btn-xs custom_button'
              ]
            );
            $myHourlies_Created .= '
            <tr>
              <td>'.Html::a($title, '../hourlies/update?id='.$id).'</td>
              <td>'.Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()).' '. $price.'</td>
              <td>'.$date.'</td>
              <td>'.$category.'</td>
              <td>'.$promotedstate.' '.$activestate.'</td>
              <td>
              <a href="'.Url::base(true).'/hourlies/'.$SeoURL.'-'.$id.'" target="_blank">
                <i class="fa fa-eye" aria-hidden="true"></i>
              </a>
                  <a href="../hourlies/update?id='.$id.'">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </a>
                  '.$delete.'
            </tr>
            ';
          }

          $Jobs_awarded = Job::find()->where(['freelancer'=>$model->id])->all();
          foreach($Jobs_awarded as $jobaward)
          {
            $id2 = $jobaward['id'];
            $title2 = $jobaward['title'];
            $user2 = $jobaward['user_id'];
            $category2 = $jobaward['category'];
            $date_created2 = $jobaward['date_created'];
            $date_expire2 = $jobaward['date_expire'];
            $budget2 = $jobaward['budget'];
            $promoted2 = $jobaward['promoted'];
            $paid2 = $jobaward['paid'];
            $completed2 = $jobaward['success'];
            $freelancer2 = $jobaward['freelancer'];
            $isEscro2 = $jobaward['isEscro'];
            $freelancer_paid2 = $jobaward['freelancer_paid'];
            $released_escro2 = $jobaward['released_escro'];
            $buyer_cancelled2 = $jobaward['buyer_cancelled'];
            $seller_cancelled2 = $jobaward['seller_cancelled'];
            $user2 = $jobaward['user_id'];

            $isinescro2 = 'No';
            if($isEscro2 == 1)
            {
              $isinescro2 = 'Yes';
            }
            $issues2 = 'No';
            if($buyer_cancelled == 1 || $seller_cancelled == 1)
            {
              $issues2 = 'yes';
            }
            if($completed2 == 0)
            {
              $status2 = '<small class="label bg-yellow">'.Yii::t('backend', 'In Progress').'</small>';

            }
            if($completed2 == 1)
            {
              $status2 = '<small class="label bg-green">'.Yii::t('backend', 'Completed').'</small>';

            }
            if($freelancer_paid2 == 1)
            {
              $status2 = '<small class="label bg-blue">'.Yii::t('backend', 'Frelncer paid').'</small>';

            }

            $jobsawarded .= '
            <tr>
              <td>'.$title2.'</td>
              <td>'.$status2.'</td>
              <td>'.MyHelpers::IdToName($user2).'</td>
              <td>'.MyHelpers::IdToName($freelancer2).'</td>
              <td>'.Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()).' '.$budget2.'</td>
              <td>'.$category2.'</td>
              <td>'.$isinescro2.'</td>
              <td>'.$issues2.'</td>
              <td><a href="../jobworkstream/view?id='.$id.'">
                <i class="fa fa-eye" aria-hidden="true"></i>
              </a></td>

            </tr>
            ';
          }


          $Job_proposals = JobProposals::find()->where(['user_id'=>$model->id])->all();
          foreach($Job_proposals as $prop)
          {
            $state = '<small class="label bg-yellow">Pending</small>';
            if($prop['accepted'] == 1)
            {
              $state = '<small class="label bg-green">Accepted</small>';
            }
            elseif($prop['declined'] == 1)
            {
              $state = '<small class="label bg-red">Declined</small>';
            }
            $myproposals .= '
            <tr>
              <td>'.MyHelpers::JobIdtoName($prop['job_id']).'</td>
              <td>'.Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()).' '.$prop['price'].'</td>
              <td>'.$state.'</td>
              <td>'.$prop['delivery_time'].' '.Yii::t('backend', 'Days').'</td>
              


            </tr>
            ';
          }
        return $this->render('@app/views/freelancers/view', [
            'model' => $model,
            'myboughthourlies' => $myboughthourlies,
            'myjobs' => $myjobs,
            'myHourlies_Created' => $myHourlies_Created,
            'jobsawarded' => $jobsawarded,
            'myproposals' => $myproposals,
        ]);
    }

    /**
     * Creates a new Freelancer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Freelancer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['freelancerview', 'id' => $model->id]);
        } else {
            return $this->render('@app/views/templates/freelancercreate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Freelancer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['freelancerview', 'id' => $model->id]);
        } else {
            return $this->render('@app/views/templates/freelancerupdate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Freelancer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['freelancer']);
    }

    /**
     * Finds the Freelancer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return Freelancer the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
