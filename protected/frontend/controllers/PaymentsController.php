<?php

namespace frontend\controllers;
use Yii;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use app\models\HourliesSales;
use app\models\JobProposals;
use app\models\Jobworkstream;
use app\models\Jobworkflow;
use app\models\JobworkstreamSearch;
use app\models\Hourlieworkstream;
use app\models\Withdrawals;
use app\models\PaymentRequests;
use app\models\User;
use app\models\Job;
use Symfony\Component\Intl\Intl;
use common\components\MyHelpers;
class PaymentsController extends \yii\web\Controller
{
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
      } else {

          $model = new PaymentRequests();
          if ($model->load(Yii::$app->request->post())) {
            $model->save();
          }
      $mycurrency = MyHelpers::Currency();

//escrow as seller
      $sellersums = HourliesSales::find()->where(['seller_id'=>yii::$app->user->identity->id])
                  ->andWhere(['released_escro' => '0'])
                  ->andWhere(['isEscro' => '1']);
      $sellerJob = Job::find()->where(['freelancer'=>yii::$app->user->identity->id])
                  ->andWhere(['released_escro' => '0'])
                  ->andWhere(['isEscro' => '1']);
      $escrowseller = $sellersums->sum('totalaftercommission') + $sellerJob->sum('totalaftercommission');

//escrow as buyer
      $buyerHourlie = HourliesSales::find()->where(['buyer_id'=>yii::$app->user->identity->id])
                    ->andWhere(['paid_status' => 'Success'])
                    ->andWhere(['isEscro' => '1']);
      $buyerJob = Job::find()->where(['user_id'=>yii::$app->user->identity->id])
                ->andWhere(['released_escro' => '0'])
                ->andWhere(['isEscro' => '1']);
      $escrowbuyer = $buyerHourlie->sum('total_cost') + $buyerJob->sum('agreed_price');

//available funds to withdraw
      $fundsavailableHourlie = HourliesSales::find()->where(['seller_id'=>yii::$app->user->identity->id])
                              ->andWhere(['paid_status' => 'Success'])
                              ->andWhere(['isEscro' => '1'])
                              ->andWhere(['released_escro' => '1'])
                              ->andWhere(['freelancer_paid' => '0'])
                              ->andWhere(['completed' => '1']);
      $fundsavailableJob = Job::find()->where(['freelancer'=>yii::$app->user->identity->id])
                              ->andWhere(['paid' => '1'])
                              ->andWhere(['released_escro' => '1'])
                              ->andWhere(['freelancer_paid' => '0'])
                              ->andWhere(['isEscro' => '1'])
                              ->andWhere(['success' => '1']);
      $available = $fundsavailableHourlie->sum('totalaftercommission') + $fundsavailableJob->sum('totalaftercommission') ;

      $harray = array();
      $hourliearray = HourliesSales::find()->where(['seller_id'=>yii::$app->user->identity->id])
      ->andWhere(['released_escro' => '1'])
      ->andWhere(['freelancer_paid' => '0'])
      ->andWhere(['isEscro' => '1'])
      ->andWhere(['completed' => '1'])
                              ->all();
                              foreach ($hourliearray as $hours) {
                                $iswithdrawn = PaymentRequests::find()->where(['hourlie_id' => $hours['id']])->one();
                                $harray[] = array('title' => $hours['item_name'], 'type' => 'Hourlie', 'price' => $hours['totalaftercommission'], 'withdraw' => $withdraw, 'id' =>$hours['id']);
                              }
      $jarray = array();
      $jobarray = Job::find()->where(['freelancer'=>yii::$app->user->identity->id])
      ->andWhere(['released_escro' => '1'])
      ->andWhere(['freelancer_paid' => '0'])
      ->andWhere(['isEscro' => '1'])
      ->andWhere(['success' => '1'])
                              ->all();
                              foreach ($jobarray as $jobs) {
                                $iswithdrawn = PaymentRequests::find()->where(['job_id' => $jobs['id']])->one();
                                //$withdraw = Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Withdraw') : Yii::t('frontend', 'Withdraw'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary btn-block']);;
                                $jarray[] = array('title' => $jobs['title'], 'type' => 'Job', 'price' => $jobs['totalaftercommission'], 'withdraw' => $withdraw, 'id' => $jobs['id']);
                              }

      //Table for Freelancer to withdraw funds
      $combine = array_merge($harray, $jarray);
      foreach ($combine as $key => $value) {
        $title = $combine[$key]['title'];
        $type = $combine[$key]['type'];
        $price = $combine[$key]['price'];
        $withdraw = $combine[$key]['withdraw'];
        $id = $combine[$key]['id'];
        $status = $combine[$key]['paid'];
        $withdraw = Html::a('Withdraw', ['withdraw/', 'id' => $id, 'type' => $type, 'sum' => $price], ['class' => 'btn btn-warning']);
        $iswithdrawn = PaymentRequests::find()->where(['job_id' => $id])->orWhere(['hourlie_id' => $id])->one();

        if(!empty($iswithdrawn))
        {
          $withdraw = '<small class="label bg-blue-active color-palette">'.Yii::t('frontend', 'Pending Withdrawal').'</small>';
        }
        if($iswithdrawn['paid'] == 1){
          $withdraw = '<small class="label bg-green-active color-palette">'.Yii::t('frontend', 'Paid Out').'</small>';
        }

        $PaymentsTable .= '
        <tr>
          <td>'.$title.'</td>
          <td>'.$type.'</td>
          <td>'.Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()) . $price.'</td>
          <td>'.$withdraw.'</td>
        </tr>
        ';
      }

      //Table for buyer Escrow
      $buyerhourliearray = array();
      $hourliearray2 = HourliesSales::find()->where(['buyer_id'=>yii::$app->user->identity->id])
      ->andWhere(['freelancer_paid' => '0'])
      ->andWhere(['isEscro' => '1'])
      ->all();
                              foreach ($hourliearray2 as $hours2) {
                                $iswithdrawn2 = PaymentRequests::find()->where(['hourlie_id' => $hours2['id']])->one();
                                $buyerhourliearray[] = array('title' => $hours2['item_name'], 'type' => 'Hourlie', 'price' => $hours2['total_cost'], 'withdraw' => $withdraw, 'id' =>$hours2['id']);
                              }
      $jbuyrerarray = array();
      $jobarray2 = Job::find()->where(['user_id'=>yii::$app->user->identity->id])
      ->andWhere(['freelancer_paid' => '0'])
      ->andWhere(['isEscro' => '1'])
      ->all();
                              foreach ($jobarray2 as $jobs2) {
                                $iswithdrawn2 = PaymentRequests::find()->where(['job_id' => $jobs2['id']])->one();
                                //$withdraw = Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Withdraw') : Yii::t('frontend', 'Withdraw'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary btn-block']);;
                                $jbuyrerarray[] = array('title' => $jobs2['title'], 'type' => 'Job', 'price' => $jobs2['agreed_price'], 'withdraw' => $withdraw, 'id' => $jobs2['id']);
                              }
      $combine2 = array_merge($buyerhourliearray, $jbuyrerarray);
      foreach ($combine2 as $key => $value) {
        $title = $combine2[$key]['title'];
        $type = $combine2[$key]['type'];
        $price = $combine2[$key]['price'];
        $withdraw = $combine2[$key]['withdraw'];
        $id = $combine2[$key]['id'];
        $status = $combine2[$key]['paid'];
        $type = $combine2[$key]['type'];

        $iswithdrawn = PaymentRequests::find()->where(['job_id' => $id])->orWhere(['hourlie_id' => $id])->one();

        if($type == 'Hourlie')
        {
          $stream = Hourlieworkstream::find()->where(['job_id' => $id])->one();
          if($stream['is_finished'] == 1)
          {
            $withdraw = Html::a('Waiting Release', ['jobworkstream/'.$id], ['class' => 'btn btn-danger']);
          }
          else {
            $withdraw = Html::a('In Progress', ['jobworkstream/'.$id], ['class' => 'btn btn-success']);
          }
        }
        if($type == 'Job'){
          $stream = Jobworkstream::find()->where(['job_id' => $id])->one();
          if($stream['is_finished'] == 1)
          {
            $withdraw = Html::a('Waiting Release', ['jobworkstream/'.$id], ['class' => 'btn btn-danger']);
          }
          else {
            $withdraw = Html::a('In Progress', ['jobworkstream/'.$id], ['class' => 'btn btn-success']);
          }

        }

        $MyBuyertable .= '
        <tr>
          <td>'.$title.'</td>
          <td>'.Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()) . $price.'</td>
          <td>'.$withdraw.'</td>
        </tr>
        ';
      }

      //Table for Seller Escrow
      $sellersumsarray = HourliesSales::find()->where(['seller_id'=>yii::$app->user->identity->id])
                  ->andWhere(['released_escro' => '0'])
                  ->andWhere(['isEscro' => '1'])
                  ->all();
      $sellerJobarray = Job::find()->where(['freelancer'=>yii::$app->user->identity->id])
                  ->andWhere(['released_escro' => '0'])
                  ->andWhere(['isEscro' => '1'])
                  ->all();;
                  $sellerhourliearray = array();
                  $sellerjarray = array();
                  foreach ($sellersumsarray as $sellerharray) {
                    $iswithdrawn2 = PaymentRequests::find()->where(['hourlie_id' => $sellerharray['id']])->one();
                    $sellerhourliearray[] = array('title' => $sellerharray['item_name'], 'type' => 'Hourlie', 'price' => $sellerharray['totalaftercommission'], 'withdraw' => $withdraw, 'id' =>$sellerharray['id']);
                  }
                  foreach ($sellerJobarray as $jobs3) {
                    $iswithdrawn2 = PaymentRequests::find()->where(['job_id' => $jobs3['id']])->one();
                    //$withdraw = Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Withdraw') : Yii::t('frontend', 'Withdraw'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary btn-block']);;
                    $sellerjarray[] = array('title' => $jobs3['title'], 'type' => 'Job', 'price' => $jobs3['totalaftercommission'], 'withdraw' => $withdraw, 'id' => $jobs3['id']);
                  }
        $combine3 = array_merge($sellerhourliearray, $sellerjarray);
      foreach ($combine3 as $key => $value) {
        $title = $combine3[$key]['title'];
        $id = $combine3[$key]['id'];
        $status = $combine3[$key]['paid'];
        $price = $combine3[$key]['price'];
        $type = $combine3[$key]['type'];

        $iswithdrawn = PaymentRequests::find()->where(['job_id' => $id])->orWhere(['hourlie_id' => $id])->one();

        if($type == 'Hourlie')
        {
          $stream = Hourlieworkstream::find()->where(['job_id' => $id])->one();
          if($stream['is_finished'] == 1)
          {
            $withdraw = Html::a('Waiting Release', ['jobworkstream/'.$id], ['class' => 'btn btn-danger']);
          }
          else {
            $withdraw = Html::a('In Progress', ['jobworkstream/'.$id], ['class' => 'btn btn-success']);
          }
        }
        if($type == 'Job'){
          $stream = Jobworkstream::find()->where(['job_id' => $id])->one();
          if($stream['is_finished'] == 1)
          {
            $withdraw = Html::a('Waiting Release', ['jobworkstream/'.$id], ['class' => 'btn btn-danger']);
          }
          else {
            $withdraw = Html::a('In Progress', ['jobworkstream/'.$id], ['class' => 'btn btn-success']);
          }

        }

        $MySellertable .= '
        <tr>
          <td>'.$title.'</td>
          <td>'.Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()) . $price.'</td>
          <td>'.$withdraw.'</td>
        </tr>
        ';
      }


      if(Yii::$app->user->identity->is_freelancer == 1)
      {
        return $this->render('paymentreelancer',[
          'model' => $model,
          'sellerescrow'=> $escrowseller,
          'buyerescrow'=> $escrowbuyer,
          'currency' => $mycurrency,
          'availablefunds' => $available,
          'PaymentsTable' => $PaymentsTable,
          'MyBuyertable' => $MyBuyertable,
          'MySellertable' => $MySellertable,
        ]);
      }
      else {
        {
          return $this->render('paymentmember',[
            'model' => $model,
            'sellerescrow'=> $escrowseller,
            'buyerescrow'=> $escrowbuyer,
            'currency' => $mycurrency,
            'availablefunds' => $available,
            'MyBuyertable' => $MyBuyertable,
            'MySellertable' => $MySellertable,
          ]);
        }
      }
    }
  }
}
