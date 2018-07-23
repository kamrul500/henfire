<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use app\models\Hourlies;
use app\models\HourliesSearch;
use app\models\HourliesSales;
use app\models\HourliesReviews;
use app\models\Hourlieworkstream;
use frontend\models\SkillsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\helpers\Json;
use app\models\JobProposals;
use app\models\Job;
use app\models\AppsCountries;
use common\components\MyHelpers;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use kartik\widgets\StarRating;
use app\models\User;
use Symfony\Component\Intl\Intl;
use matthuffy\MatthuffyPaypal\MatthuffyPaypal;

/**
 * HourliesController implements the CRUD actions for Hourlies model.
 */
class HourliesController extends Controller
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
     * Lists all Hourlies models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HourliesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //display the county list//
        $countries = AppsCountries::find()->where(['display'=>'1'])
                   ->all();

        $cList = '';
        foreach ($countries as $country)
        {

          $cList.= '<li>'.Html::checkBox('country[]', false, ['label' => Yii::t('frontend', $country['country_name']), 'value' => $country['country_code'], 'class' => 'countrylink']).'</li>';
        }

        return $this->render('@app/views/templates/hourlies', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'CountryList' => $cList,
        ]);
    }

    /**
     * Displays a single Hourlies model.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
      $current_user=Yii::$app->user->identity->id;
      $session = Yii::$app->session;
      $session['userView'] = [
              'user' => $current_user,
              'returnURL' => Yii::$app->request->url,
              ];

      $model = $this->findModel($id);
      Yii::$app->db->createCommand("UPDATE {{%hourlies}} SET views=views+1 WHERE id = '$model->id' ")->execute();

      $mainIMG = json_decode($model->images);

      $updatebuton = '';
      if($model->user_id == Yii::$app->user->identity->id)
      {
        $updatebuton = Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
      }
      $images = '';
      $thumbnail = '';
      $videothumb = '';
      $video = Html::encode($model->video);

      if ($video) {
          $vidurl = parse_url($video);
          $station = $vidurl['host'];

          if ($station == 'www.youtube.com') {
              $pieces = explode('watch?v=', $video);
              $videoImage = $pieces[1];
              $frame = 10;
              $vidtype = 'youtube';
          } elseif ($station == 'vimeo.com') {
              $pieces = explode('vimeo.com/', $video);
              $vidlink = $pieces[1];
              $hash = file_get_contents("https://vimeo.com/api/oembed.json?url=$video");
              $has_result = json_decode($hash);
              $videoImage = $has_result->thumbnail_url_with_play_button;
              $videoThumb = $has_result->thumbnail_url;
              $vimeo_vid_id = $hash_result->video_id;
              $vidtype = 'vimeo';
          }
      }

          if (!empty($vidtype)) {
              if ($vidtype == 'youtube'):
                  $video = '<div class="sp-slide"><a class="sp-video" href="'.$video.'">
                      <img src="http://img.youtube.com/vi/'.$videoImage.'/0.jpg" data-src="http://img.youtube.com/vi/'.$videoImage.'/0.jpg" height="100%" width="100%"/>
                  </a></div>';
              $videothumb = '<img class="sp-thumbnail" src="http://img.youtube.com/vi/'.$videoImage.'/0.jpg" data-src="http://img.youtube.com/vi/'.$videoImage.'/0.jpg"/>';
              endif;
              if ($vidtype == 'vimeo'):
              $video = '<div class="sp-slide"><a class="sp-video" href="http://vimeo.com/'.$vidlink.'">
      							<img src="'.$videoImage.'/0.jpg" data-src="'.$videoImage.'" height="100%" width="100%"/>
      					</a></div>';
              $videothumb = '<img class="sp-thumbnail" src="'.$videoThumb.'" data-src="'.$videoThumb.'"/>';
              endif;
          }
        $name = Yii::$app->db->createCommand('SELECT * FROM {{%user}} WHERE id="'.$model->user_id.'"');
          $reader = $name->query();
          $dataUser = $reader->readAll();
          $profile_pic = $dataUser[0]['profile_picture'];
          $currency = $dataUser[0]['currency'];
          $fullname = $dataUser[0]['full_name'];
          $occupation = $dataUser[0]['occupation'];
          $introduction = $dataUser[0]['introduction'];
          $country = $dataUser[0]['country'];
          $url_name = preg_replace("/[^\w]+/", '-', $dataUser[0]['full_name']);
          if(!empty($mainIMG))
          {
              foreach ($mainIMG as $imagefile) {
                  if (!empty($imagefile)) {
                      $images .= '<div class="sp-slide">
                  		            <img class="sp-image" src="'.$imagefile.'"/>
              			              </div>';
                      $thumbnail .= '<img class="sp-thumbnail" src="'.$imagefile.'" data-src="'.$imagefile.'"/>';
               }
             }
          }
          else {
              $images = '<div class="sp-slide">
                          <img class="sp-image" src="'.Url::base().'/assets/images/No_Image_Available.jpg'.'"/>
                          </div>';
          }
          $mycurrency = MyHelpers::Currency();
          /*if (Yii::$app->user->isGuest) {
              $mycurrency = MyHelpers::Currency();
          } else {
              $mycurrency = Yii::$app->user->identity->currency;
          }
          $theircurrency = $currency;

          $converter = new CurrencyConverter();
          $rate = $converter->convert($theircurrency, $mycurrency);*/

          $price = $model->cost;

          $sales = new HourliesSales();
      $plaural = '';
      if ($model->delivery_time > 1) {
          $plaural = 's';
      }
          $plaural = $plaural;
          $salesdb = HourliesSales::find()->where(['item_id' => $model->id])->all();
          $reviews = HourliesReviews::find()->where(['hourlie_id' => $model->id])->all();
          $mysales = count($salesdb);
          $numberOfReviews = count($reviews);
      $reviewrating = array();
      $review = '';
      foreach ($reviews as $data) {
          $starrating = StarRating::widget([
          'name' => 'rating_21',
          'value' => $data['rating'],
          'pluginOptions' => [
              'readonly' => true,
              'showClear' => false,
              'showCaption' => false,
                      'stars' => 5,
                      'min' => 0,
                      'max' => 5,
                      'size' => '22',
                      'ratingClass' => 'rating-fa',
          ],
      ]);
          $reviewerdata = User::find(['profile_picture'])->where(['id' => $data['user_id']])->one();
          $reviewer_pic = $reviewerdata['profile_picture'];
          $reviewrating[] = $data['rating'];
          $replied = Yii::t('frontend','Seller has not replied yet ');
          if ($data['replies'] != null) {
              $replied = '<a href="../profile/'.$url_name.'-'.$model->user_id.'">'.Html::img($profile_pic, ['class' => 'timelinepic']).'</a>';
          }
          $review .= '<article class="panel panel-primary">
      			<div class="panel-heading icon">
      					<h2 class="panel-title"><strong>'.Html::img('../assets/images/blank-person.jpg', ['class' => 'timelinepic']).' '.$reviewerdata['full_name'].'</strong> <i class="fa fa-map-marker" aria-hidden="true"></i> '.$reviewerdata['city'].','.$reviewerdata['country'].'<span class="pull-right reviewstars">'.$starrating.'</span></h2>

      			</div>
      			<div class="panel-body">
      					'.$data['review'].'
      			</div>
      			<div class="panel-footer">
              '.$replied.'
      				'.$data['replies'].'
      			</div>
      	</article>';
      }
      $percent_friendly = '0%';
      if(count($reviewrating)>0)
      {
      $reviewratingsum = array_sum($reviewrating) / count($reviewrating);
      $x = $reviewratingsum;
      $y = 5;

      $percent = $x / $y;
      $percent_friendly = round(number_format($percent * 100, 2)).'%';
      }
      if (strlen($introduction) > 147) {
          $introduction = substr($introduction, 0, 147).' <a href="#" data-toggle="modal" data-target="#myModal" class="green">'.Yii::t('frontend','More...').'</a>';
      }
      $dataProvider = new ActiveDataProvider([
        'query' => Hourlies::find()
        ->where(['user_id' => $model->user_id])
        ->andWhere(['<>','id', $id])
        ->orderBy(new Expression('rand()'))
        ->limit(5),
        'pagination' => false,
      ]);
      if(empty($dataProvider)){
        $dataProvider = new ActiveDataProvider([
          'query' => Hourlies::find()
          ->where(['promoted' => '1'])
          ->orderBy(new Expression('rand()'))
          ->limit(3),
          'pagination' => false,
        ]);
      }
        return $this->render('@app/views/templates/hourliesview', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'mycurrency' => $mycurrency,
            'price' => $price,
            'sales' => $sales,
            'plaural' => $plaural,
            'percent_friendly' => $percent_friendly,
            'numberOfReviews' => $numberOfReviews,
            'mysales' => $mysales,
            'video' => $video,
            'images' => $images,
            'videothumb' => $videothumb,
            'thumbnail' => $thumbnail,
            'review'=> $review,
            'profile_pic' => $profile_pic,
            'fullname' => $fullname,
            'occupation' => $occupation,
            'introduction' => $introduction,
            'country' => $country,
            'updatebuton' => $updatebuton,

        ]);
    }

    public function actionAbout()
    {
        return $this->render('@app/views/templates/hourliesabout');
    }

    public function actionTags()
    {
        $searchModel = new SkillsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('@app/views/templates/hourliestag', [
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Creates a new Hourlies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(Yii::$app->urlManager->createUrl('user/login'));

            return true;
        } else {
            $model = new Hourlies();
            if ($model->load(Yii::$app->request->post())) {
                $model->images = UploadedFile::getInstances($model, 'image');

                if(!empty($model->images))
                {
                $array = array();
                foreach ($model->images as $key => $file) {
                    $random = Yii::$app->security->generateRandomString();
                    $file->saveAs(Yii::getAlias('@uploads').'/'.$random.'.'.$file->extension); //Upload files to server
                        $array[] .= Url::base().'/uploads/'.$random.'.'.$file->extension; //Save file names in database- '**' is for separating images
                 }
                 $model->images = Json::encode(array_values($array));
                }



                $model->save();
                $string = preg_replace("/[^\w]+/", '-', $model->title);
                $SeoURL = strtolower($string);
                return $this->render('@app/views/templates/promote', [
                        'model' => $model,
                        'SeoURL' => $SeoURL,
                    ]);
            } else {
              if(MyHelpers::IsFreelancer(Yii::$app->user->identity->id) == 1)
              {
                return $this->render('@app/views/templates/hourliescreate', [
                        'model' => $model,
                    ]);
              }
              else
              {
                return $this->render('@app/views/templates/notfreelancer', [
                        'model' => $model,
                    ]);
              }
            }
        }
    }
     /**
      * Updates an existing Hourlies model.
      * If update is successful, the browser will be redirected to the 'view' page.
      *
      * @param int $id
      *
      * @return mixed
      */
     public function actionUpdate($id)
     {
         $model = $this->findModel($id);
         if ($model->user_id != Yii::$app->user->identity->id) {
             $this->redirect(Yii::$app->urlManager->createUrl('user/login'));

             return true;
         }
         if (Yii::$app->user->isGuest) {
             $this->redirect(Yii::$app->urlManager->createUrl('user/login'));

             return true;
         }

         if ($model->load(Yii::$app->request->post())) {
           $model->images = UploadedFile::getInstances($model, 'image');
           if(!empty($model->images))
           {
           $array = array();
           foreach ($model->images as $key => $file) {
               $random = Yii::$app->security->generateRandomString();
               $file->saveAs(Yii::getAlias('@uploads').'/'.$random.'.'.$file->extension); //Upload files to server
                   $array[] .= Url::base().'/uploads/'.$random.'.'.$file->extension; //Save file names in database- '**' is for separating images
           }
           $model->images = Json::encode(array_values($array));
           }
           $model->save();

           $string = preg_replace("/[^\w]+/", '-', $model->title);
           $SeoURL = strtolower($string);
           return $this->redirect(['hourliesview'.$SeoURL.'-'.$id]);
         } else {
             return $this->render('@app/views/templates/hourliesupdate', [
                 'model' => $model,
             ]);
         }
     }

    /**
     * Deletes an existing Hourlies model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['hourlies']);
    }


    //Mange bought hourlies
    public function actionManage()
    {
      $isfreelancer = MyHelpers::IsFreelancer(yii::$app->user->identity->id);
      $myJobs = Job::find()->where(['user_id' => Yii::$app->user->identity->id])
      ->orderBy(['paid' => SORT_ASC])
      ->all();
      $countjobs = Job::find()->where(['user_id' => Yii::$app->user->identity->id])
      ->andWhere(['success' => 0])
      ->all();
      $sumopenjobs = count($countjobs);
      $countHourlies = HourliesSales::find()->where(['buyer_id' => Yii::$app->user->identity->id])
      ->andWhere(['completed' => 0])
      ->all();
      $sumostreams = count($countHourlies);
      foreach($myJobs as $jobkey)
      {
        $freelancer = $jobkey['freelancer'];
        $proposals = JobProposals::find()->where(['job_id' => $jobkey['id']])->all();
        $numberofproposals = count($proposals);
        $paid = $jobkey['paid'];
        $success = $jobkey['success'];
        if($paid == 0)
        {
          $status = '<small class="label bg-blue">'.Yii::t('backend', 'Waiting Proposals').'</small>';
          $proposaltab =  '<a href="../job-proposals?JobProposalsSearch[job_id]='.$jobkey['id'].'">'.$numberofproposals.' Proposals</a>';
        }
        if($paid == 0 && $freelancer >= 1)
        {
          $owe = JobProposals::find()->where(['job_id' => $jobkey['id']])
          ->andWhere(['accepted' => 1])
          ->one();
          $status = '<small class="label bg-black">'.Yii::t('backend', 'Pending Deposit').'</small>';
          $proposaltab =  '<a href="../job-proposals/accept?id='.$owe['id'].'"><small class="label bg-black">'.Yii::t('backend', 'Deposit Funds').'</small></a>';
        }
        elseif($paid == 1)
        {
          $status = '<small class="label bg-yellow">'.Yii::t('backend', 'In Progress').'</small>';
          $proposaltab =  '<a href="../jobworkstream/'.$jobkey['id'].'"><small class="label bg-yellow">'.Yii::t('backend', 'View Stream').'</small></a>';
        }
        elseif($success == 1)
        {
          $status = '<small class="label bg-blue">'.Yii::t('backend', 'Hourlie Finished').'</small>';
          $proposaltab =  '<a href="../jobworkstream/'.$jobkey['id'].'"><small class="label bg-blue">'.Yii::t('backend', 'Release Escrow').'</small></a>';
        }
        elseif($freelancer_paid == 1)
        {
          $status = '<small class="label bg-green">'.Yii::t('backend', 'Completed').'</small>';
          $proposaltab =  '<small class="label bg-green">'.Yii::t('backend', 'Finished').'</small>';
        }

        $jobsTable .= '
        <tr>
          <td><a href="../jobworkstream/'.$jobkey['id'].'">'.$jobkey['title'].'</a></td>
          <td>'.$status.'</td>
          <td>'.Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()).' '.$jobkey['budget'].'</td>
          <td>'.$proposaltab.'</td>
        </tr>
        ';
      }

      $myJobs = HourliesSales::find()->where(['buyer_id' => Yii::$app->user->identity->id])
      ->orderBy(['completed' => SORT_ASC])
      ->all();
      foreach ($myJobs as $key => $value) {
        $Hworkstream = Hourlieworkstream::find()->where(['job_id' => $myJobs[$key]['id']])->one();
        if($myJobs[$key]['paid_status'] == 'Pending')
        {
          $status = '<small class="label bg-red">'.Yii::t('backend', 'Failed').'</small>';
          $flow = '<small class="label bg-red">'.Yii::t('backend', 'None').'</small>';
        }
        else {
          $status = '<small class="label bg-green">'.Yii::t('backend', 'Paid').'</small>';
          if($Hworkstream['is_finished'] == 0)
          {
            $flow = '<a href="../hourlieworkstream/'.$myJobs[$key]['id'].'"><small class="label bg-yellow">'.Yii::t('backend', 'In Progress..').'</small></a>';
          }
          elseif($myJobs[$key]['completed'] == 0 && $Hworkstream['is_finished'] == 1)
          {
            $flow = '<a href="../hourlieworkstream/'.$myJobs[$key]['id'].'"><small class="label bg-blue">'.Yii::t('backend', 'Release Escrow').'</small></a>';
          }
          elseif($myJobs[$key]['completed'] == 1 && $myJobs[$key]['released_escro'] == 1)
          {
            $flow = '<small class="label bg-green">'.Yii::t('backend', 'Completed').'</small>';
          }
        }
        $HourliesTable .= '
        <tr>
          <td><a href="../hourlieworkstream/'.$myJobs[$key]['id'].'">'.$myJobs[$key]['item_name'].'</a></td>
          <td>'.Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()).' '.$myJobs[$key]['total_cost'].'</td>
          <td>'.$myJobs[$key]['date_bought'].'</td>
          <td>'.$status.'</td>
          <td>'.$flow.'</td>
        </tr>
        ';
      }

      $mysales = HourliesSales::find()->where(['seller_id' => Yii::$app->user->identity->id])
      ->orderBy(['completed' => SORT_ASC])
      ->all();
      foreach ($mysales as $key => $value) {
        # code...
        if($mysales[$key]['completed'] == 0 && $Hworkstream['is_finished'] == 1)
        {
          $flow2 = '<a href="../hourlieworkstream/'.$mysales[$key]['id'].'"><small class="label bg-blue">'.Yii::t('backend', 'Release Escrow').'</small></a>';
        }
        elseif($mysales[$key]['completed'] == 1 && $mysales[$key]['released_escro'] == 1)
        {
          $flow2 = '<small class="label bg-green">'.Yii::t('backend', 'Completed').'</small>';
        }
        else {
          $flow2 = '<a href="../hourlieworkstream/'.$mysales[$key]['id'].'"><small class="label bg-yellow">'.Yii::t('backend', 'In Progress..').'</small></a>';
        }
        $MyHourlieSales .= '
        <tr>
          <td><a href="../hourlieworkstream/'.$mysales[$key]['id'].'">'.$mysales[$key]['item_name'].'</a></td>
          <td>'.Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()).' '.$mysales[$key]['total_cost'].'</td>
          <td>'.$mysales[$key]['date_bought'].'</td>
          <td>'.$status.'</td>
          <td>'.$flow2.'</td>
        </tr>';
      }
      $Jovsawardedget = Job::find()->where(['freelancer' => Yii::$app->user->identity->id])->all();

      foreach ($Jovsawardedget as $key => $value) {
        # code...
        if($Jovsawardedget[$key]['paid'] == 0)
        {
          $flow3 = '<a href="../jobworkstream/'.$Jovsawardedget[$key]['id'].'"><small class="label bg-red">'.Yii::t('backend', 'Pending Payment').'</small></a>';
        }
        if($Jovsawardedget[$key]['paid'] == 1 && $Jovsawardedget[$key]['success'] == 0)
        {
          $flow3 = '<a href="../jobworkstream/'.$Jovsawardedget[$key]['id'].'"><small class="label bg-yellow">'.Yii::t('backend', 'In progress..').'</small></a>';
        }
        elseif($Jovsawardedget[$key]['success'] == 1 && $Jovsawardedget[$key]['released_escro'] == 0)
        {
          $flow3 = '<a href="../jobworkstream/'.$Jovsawardedget[$key]['id'].'"><small class="label bg-blue">'.Yii::t('backend', 'Waiting Escrow').'</small></a>';
        }
        elseif($Jovsawardedget[$key]['success'] == 1 && $Jovsawardedget[$key]['released_escro'] == 1)
        {
          $flow3 = '<a href="../jobworkstream/'.$Jovsawardedget[$key]['id'].'"><small class="label bg-green">'.Yii::t('backend', 'Paid').'</small></a>';
        }
        $jobsawarded .='
        <tr>
          <td><a href="../jobworkstream/'.$Jovsawardedget[$key]['id'].'">'.$Jovsawardedget[$key]['title'].'</a></td>
          <td>'.$status.'</td>
          <td>'.Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()).' '.$Jovsawardedget[$key]['agreed_price'].'</td>
          <td>'.$flow3.'</td>
        </tr>';

      }

      //render view
      if($isfreelancer == 0)
      {
        return $this->render('@app/views/templates/manage', [
                   'jobsTable' => $jobsTable,
                   'HourliesTable' => $HourliesTable,
                   'sumopenjobs' => $sumopenjobs,
                   'sumostreams' => $sumostreams,

               ]);
      }
      else {
        return $this->render('@app/views/templates/managefreelancer', [
                     'jobsTable' => $jobsTable,
                     'HourliesTable' => $HourliesTable,
                     'sumopenjobs' => $sumopenjobs,
                     'sumostreams' => $sumostreams,
                     'MyHourlieSales'  => $MyHourlieSales,
                     'jobsawarded' => $jobsawarded,

              ]);
      }
    }
    public function actionPromote()
    {
      $paypal = new MatthuffyPaypal();
          $post = Yii::$app->request->post('Hourlies');
          $id = $post['id'];
          $model = $this->findModel($id);
          $clientId = MyHelpers::PayPalAuth();
          $clientSecret = MyHelpers::PayPalSecret();
          $agreementSucess = Url::home(true).'hourlies/paymentsuccess?success=true';
          $agreementCancelled = Url::home(true).'hourlies/paymentsuccess?success=false';
          if($post['promoted'] == 1)
          {
            $price = MyHelpers::FeatureHourliePrice();
          }
          if($post['promoted'] == 2)
          {
            $price = MyHelpers::FeatureHourliePrice() * 4;
          }
          if($post['promoted'] == 3)
          {
            $price = MyHelpers::FeatureHourliePrice() * 52;
          }
          $purchaseDetails = array(
        'itemName' => 'Hourie Promote',
        'currency' => MyHelpers::Currency(),
        'quantity' => '1',
        'SKU' => 'Hourlie Promotion',
        'price' => $price,
        'shipping' => '0',
        'tax' => '0',
        'subtotal' => $price,
        'total' => $price,
        'description' => 'Promote your Hourlie with '.MyHelpers::WebsiteName(),
        );
          $paypal->setPPcreds($clientId, $clientSecret, MyHelpers::PayPalEnvironment(), $agreementSucess, $agreementCancelled);
          //if ($post['payment_type'] == 'PayPal') {
              $return = $paypal->paypalPayment($purchaseDetails);
              $payid = $return->getId();
              $model->promoted_paypal_auth = $payid;
              $model->promoted_term = $post['promoted'];
              $model->save();
              $link = $return->getApprovalLink();
              echo $link;

              return $this->redirect($link);
        //}
  }
  public function actionPaymentsuccess()
  {
    $get = Yii::$app->request->get();
    if ($get['success'] == 'true') {
        $paymentID = $get['paymentId'];
        $token = $get['token'];
        $payerid = $get['PayerID'];
        $transaction_details = Hourlies::find()->where(['promoted_paypal_auth' => $paymentID])->one();
        $term = $transaction_details['promoted_term'];
        if($term == 1)
        {
          $price = MyHelpers::FeatureHourliePrice();
        }
        if($term == 2)
        {
          $price = MyHelpers::FeatureHourliePrice() * 4;
        }
        if($term == 3)
        {
          $price = MyHelpers::FeatureHourliePrice() * 52;
        }
        $purchaseDetails = array(
    'itemName' => 'Hourie Promote',
    'currency' => MyHelpers::Currency(),
    'quantity' => '1',
    'SKU' => 'Hourlie Promotion',
    'price' => $price,
    'shipping' => '0',
    'tax' => '0',
    'subtotal' => $price,
    'total' => $price,
    'description' => 'Promote your Hourlie with '.MyHelpers::WebsiteName(),
    );

        $clientId = MyHelpers::PayPalAuth();
        $clientSecret = MyHelpers::PayPalSecret();
        $agreementSucess = 'none';
        $agreementCancelled = 'none';

    $paypal = new MatthuffyPaypal();
    $paypal->setPPcreds($clientId, $clientSecret, MyHelpers::PayPalEnvironment(), $agreementSucess, $agreementCancelled);
    $paypal->executePayment('true', $paymentID, $payerid, $purchaseDetails);
    $id = $transaction_details['id'];

    $id = $transaction_details['id'];

    Yii::$app->db->createCommand('UPDATE {{%hourlies}} SET 	promoted=1 WHERE id= '.$id)->execute();

    Yii::$app->mailer->compose()
      ->setTo(Yii::$app->user->identity->email)
      ->setFrom([MyHelpers::WebsiteEmail() => MyHelpers::WebsiteName()])
      ->setSubject(Yii::t('frontend','Feature Hourlie Successful'))
      ->setTextBody('You have Featured yoru Hourlie')
      ->setHtmlBody('<b>Dear '.Yii::$app->user->identity->username.'</b>
      <br />
      You have successfullt Featured your Hourlie.
      <br /><b>'.$transaction_details['title'].'</b>
      <br />Price: '.$price.'
      ')
      ->send();

        return $this->redirect(['/hourlies']);
  }
  }
    /**
     * Finds the Hourlies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return Hourlies the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hourlies::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
