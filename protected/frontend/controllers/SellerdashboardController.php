<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use app\models\HourliesSales;
use app\models\JobProposals;
use app\models\Job;
use app\models\User;
use common\components\MyHelpers;

class SellerdashboardController extends \yii\web\Controller
{
  public function beforeAction($action)
  {
    $current_user=Yii::$app->user->identity->id;
    $session = Yii::$app->session;
    $session['userView'] = [
            'user' => $current_user,
            'returnURL' => Yii::$app->request->url,
            ];
      if (Yii::$app->user->isGuest) {
          $this->redirect(Yii::$app->urlManager->createUrl('user/login'));

      }
        return true;
  }

  public function actionIndex()
  {
    $current_user=Yii::$app->user->identity->id;
    $session = Yii::$app->session;
    $session['userView'] = [
            'user' => $current_user,
            'returnURL' => Yii::$app->request->url,
            ];
    if (Yii::$app->user->isGuest) {
        $this->redirect(Yii::$app->urlManager->createUrl('user/login'));
        return true;
    }
    $pending = HourliesSales::find()->where(['buyer_id'=>yii::$app->user->identity->id])
               ->andWhere(['!=','paid_status', 'Success'])->all();
    $sellerdashboard = Html::a('Buyers Dashboard', ['/dashboard'], ['class'=>'btn btn-default']);
    $openjobs = Job::find()->where(['user_id'=>yii::$app->user->identity->id])
               ->andWhere(['success' => '0'])->all();
    $openjobsreturn = '';
    if(empty($openjobs))
    {
      $openjobsreturn = "<div class='col-md-12 text-center nojobs'>
      <div><h4>You have no jobs, why not create a new job?</h4></div>
      ".Html::a('Create a Job', ['/job/new?r=post_new_job'], ['class'=>'btn btn-default'])."</div>";
    }
    else {
    foreach ($openjobs as $joblist)
    {
      $proposals = JobProposals::find()->where(['job_id'=>$joblist['id']])->all();

      $listproposals = count($proposals);
      $string = preg_replace("/[^\w]+/", '-', $joblist['title']);
      $SeoURL = strtolower($string);
      $openjobsreturn .= '<div class="col-md-12">
         <div class="col-md-10">
            <div class="">'.Html::a($joblist['title'], 'job/'.$SeoURL.'-'.$joblist['id']).'</div>
         </div>
         <div class="com-md-2">
            <div class="">Budget:'.$joblist['budget'].'</div>
         </div>
         <div class="col-md-12 offers">'.Html::a('Proposals '.$listproposals, 'job-proposals?JobProposalsSearch%5Bjob_id%5D='.$joblist['id']).'</div>
      </div>';
    }
  }
    $workstream = Job::find()->where(['user_id'=>yii::$app->user->identity->id])
               ->andWhere(['success' => '0'])
               ->andWhere(['>','freelancer', '0'])->all();
    $openworkstreams = '';
    if(empty($workstream))
    {
      $openworkstreams = "<div class='col-md-12 text-center noworkstream'>
      <div><h4>You have no current workstreams, get started by creating a new job?</h4></div>
      ".Html::a('Create a Job', ['/job/new?r=post_new_job'], ['class'=>'btn btn-default'])."</div>";
    }
    else {


      foreach ($workstream as $streamlist)
               {
      $proposals = JobProposals::find()->where(['job_id'=>$streamlist['id']])
                ->andWhere(['accepted' => '1'])->one();
      $freelancer = User::find()->where(['id'=>$proposals['user_id']])->one();
                $string = preg_replace("/[^\w]+/", '-', $streamlist['title']);
                $SeoURL = strtolower($string);
                $freelanceurl = preg_replace("/[^\w]+/", '-', $freelancer['full_name']);
                $Seofreelanceurl = strtolower($freelanceurl);
                $openworkstreams .= '<div class="col-md-12">
                   <div class="col-md-10">
                      <div class="">'.Html::a($streamlist['title'], 'job/'.$SeoURL.'-'.$streamlist['id']).'</div>
                   </div>
                   <div class="com-md-2">
                      <div class="">Cost: '.$proposals['price'].'</div>
                   </div>

                   <div class="col-md-12 offers">Worker: '.Html::a($freelancer['full_name'], 'profile/'.$Seofreelanceurl.'-'.$freelancer['id']).'</div>
                </div>';
               }
      }
    $sumpending = count($pending);
    $sumopenjobs = count($openjobs);
    $wumworkstream = count($workstream);


      return $this->render('@app/views/templates/sellerdashboard',
    ['sumopenjobs' => $sumopenjobs, 'wumworkstream' => $wumworkstream, 'sumpending' => $sumpending,
     'openjobsreturn' => $openjobsreturn, 'openworkstreams' => $openworkstreams, 'sellerdashboard' => $sellerdashboard ]);
  }
}
