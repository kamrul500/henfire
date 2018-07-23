<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use app\models\Hourlies;
use app\models\HourliesSales;
use app\models\JobProposals;
use app\models\Job;
use app\models\User;
use app\models\Hourlieworkstream;
use common\components\MyHelpers;

class DashboardController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(Yii::$app->urlManager->createUrl('user/login'));

        }
          return true;
    }

    public function actionIndex()
    {
      if (Yii::$app->user->isGuest) {
          $this->redirect(Yii::$app->urlManager->createUrl('user/login'));
          return true;
      }
      $this->redirect(Yii::$app->urlManager->createUrl('/profile'));
      //return the freelancer dashboard
      /*
      if(Yii::$app->user->identity->is_freelancer == 1)
      {
        $openjobs = Job::find()->where(['freelancer'=>yii::$app->user->identity->id])
        ->andWhere(['buyer_cancelled' => '0'])
        ->andWhere(['seller_cancelled' => '0'])
        ->andWhere(['released_escro' => '0'])->all();
        $sumopenjobs = count($openjobs);

        $openhourlies = HourliesSales::find()->where(['seller_id'=>yii::$app->user->identity->id])

                   ->andWhere(['!=','paid_status', 'Pending'])
                   ->andWhere(['completed' => '0'])
                   ->andWhere(['buyer_cancelled' => '0'])
                   ->andWhere(['seller_cancelled' => '0'])
                   ->andWhere(['isEscro' => '1'])->all();
        $sumopenhourlies = count($openhourlies);

        $totalhourlies = Hourlies::find()->where(['user_id'=>yii::$app->user->identity->id])
                    ->andWhere(['dissabled' => '0'])->all();
        $totalhourlies = count($totalhourlies);


        $i = 0;
        $c = true;
        foreach($openjobs as $jobkey)
        {
          $jobcreator = User::find()->where(['id'=> $jobkey['user_id']])->one();
          $activejobslist .= '
          <div '.(($c = !$c)?' id="odd"':'').' class="col-xs-12 col-sm-12 col-md-12 jobliststyle">
    			  <div class="col-xs-10 col-sm-10">
    				       <h4>'.Html::a(Html::encode($jobkey['title']), ['/jobworkstream/'.$jobkey['id'].'']).'<h4>
    			  </div>

            <div class="clearfix"></div>
            <div class="col-xs-1 col-sm-1">
                  '.Html::img(Html::encode($jobcreator['profile_picture']), ['class' => 'minipic']).'
            </div>
            <div class="col-xs-7 col-sm-7">
            <div class="username">
                  '.Html::encode($jobcreator['full_name']).'
            </div>
            <div class="country">
                  '.Html::encode($jobcreator['country']).'
            </div>
            </div>
            <div class="col-xs-3 col-sm-3 text-center">
                '.Html::a(Html::img(Html::encode($bundle->baseUrl.'assets/images/gmail.png'), ['class' => 'iconimmage']), ['/jobworkstream/'.$jobkey['id'].'']).'
    			  </div>
          </div>';
        }

        foreach($openhourlies as $hourliekey)
        {
          $buyerid = User::find()->where(['id'=> $hourliekey['buyer_id']])->one();
          $activehourlieslist .= '
          <div '.(($c = !$c)?' id="odd"':'').' class="col-xs-12 col-sm-12 col-md-12 jobliststyle">
    			  <div class="col-xs-10 col-sm-10">
    				      <h4>'.Html::a(Html::encode($hourliekey['item_name']), ['/hourlieworkstream/'.$hourliekey['id'].'']).'<h4>
    			  </div>
            <div class="clearfix"></div>
            <div class="col-xs-1 col-sm-1">
                  '.Html::img(Html::encode($buyerid['profile_picture']), ['class' => 'minipic']).'
            </div>
            <div class="col-xs-7 col-sm-7">
            <div class="username">
                  '.Html::encode($buyerid['full_name']).'
            </div>
            <div class="country">
                  '.Html::encode($buyerid['country']).'
            </div>
            </div>
            <div class="col-xs-3 col-sm-3 text-center">
    				    '.Html::a(Html::img(Html::encode($bundle->baseUrl.'assets/images/gmail.png'), ['class' => 'iconimmage']), ['/hourlieworkstream/'.$hourliekey['id'].'']).'
    			  </div>
          </div>';
        }
        $sumtotaljobhourlie = $sumopenjobs + $sumopenhourlies;
        return $this->render('@app/views/templates/dashboard',
      [ 'sumopenjobs' => $sumopenjobs,
        'openhourlies' => $sumopenhourlies,
        'totalhourlies' => $totalhourlies,
        'activejobslist' => $activejobslist,
        'activehourlieslist' => $activehourlieslist,
        'sumtotaljobhourlie' => $sumtotaljobhourlie,
        ]);

      }

      //return the member dashboard
      else {
        $openjobs = Job::find()->where(['user_id'=>yii::$app->user->identity->id])
        ->andWhere(['paid' => 1])
        ->andWhere(['buyer_cancelled' => '0'])
        ->andWhere(['seller_cancelled' => '0'])
        ->andWhere(['released_escro' => '0'])->all();
        $sumopenjobs = count($openjobs);

        $hourworkstream = Hourlieworkstream::find()->where(['user_id'=>yii::$app->user->identity->id])
        ->andWhere(['is_finished' => '0'])->all();
        $sumostreams = count($hourworkstream);

        $Invoices = Job::find()->where(['user_id'=>yii::$app->user->identity->id])
        ->andWhere(['paid' => 0])
        ->andWhere(['>', 'freelancer', 0])->all();
        $sumpending = count($Invoices);

        $luminance = MyHelpers::get_avg_luminance(Yii::$app->user->identity->cover_photo, 10);
        if ($luminance > 170) {
            $textcolour = '';
        } else {
            $textcolour = 'text-light';
        }

        return $this->render('@app/views/templates/dashboardmember',
      [
        'sumopenjobs' => $sumopenjobs,
        'sumostreams' => $sumostreams,
        'sumpending' => $sumpending,
      ]);
      }
      */
    }

}
