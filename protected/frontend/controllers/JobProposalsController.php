<?php

namespace frontend\controllers;

use Yii;
use app\models\Job;
use app\models\JobProposals;
use app\models\JobQuestions;
use app\models\JobProposalsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\models\User;
use common\components\MyHelpers;
use matthuffy\MatthuffyPaypal\MatthuffyPaypal;
use yii\web\UploadedFile;
use yii\helpers\Html;

/**
 * JobProposalsController implements the CRUD actions for JobProposals model.
 */
class JobProposalsController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
     * Lists all JobProposals models.
     *
     * @return mixed
     */
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
        $searchModel = new JobProposalsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('@app/views/templates/jobproposal', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single JobProposals model.
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
      if (Yii::$app->user->isGuest) {
          $this->redirect(Yii::$app->urlManager->createUrl('user/login'));
          return true;
      }

		$model =  $this->findModel($id);
    $job = new Job();
    $theJobDetails = Job::find()->where(['id' => $model->job_id])->All();

    if ($model->user_id != Yii::$app->user->identity->id) {
      if ($theJobDetails[0]['user_id'] != Yii::$app->user->identity->id ) {
          $this->redirect(Yii::$app->urlManager->createUrl('user/login'));
          return true;
      }
    }



		$postcomment = new JobQuestions();


    if ($postcomment->load(Yii::$app->request->post())) {
			$uploadeddata = UploadedFile::getInstances($postcomment, 'upload');
			if(!empty($uploadeddata))
			{
			  $random = Yii::$app->security->generateRandomString();
			  foreach($uploadeddata as $files)
			  {
				$files->saveAs('uploads/'.$random.'.'.$files->extension);
			  }
			  $theupload = Url::home(true).'uploads/'.$random.'.'.$files->extension;
			}
			else
			{
			  $theupload = Null;
			}

			Yii::$app->db->createCommand()->insert('{{%job_questions}}', [
				'job_proposal_id' => $id,
				'job_id' => $model->job_id,
				'user_id' => Yii::$app->user->getId(),
				'question' => $postcomment->question,
				'upload' => $theupload,
			])->execute();
		}
    $i = 0;
    $c = true;
    $questions = JobQuestions::find()->where(['job_proposal_id' => $id])->All();
		foreach($questions as $value)
			{
        $poster = $value['user_id'];
        $dateposted = $value['request_date'];
        $comment = $value['question'];
        $upload = $value['upload'];
        //$profilepic = User::find(['profile_picture'])->where(['id' => $poster])->one();
        $fullname = User::find(['full_name'])->where(['id' => $poster])->one();
        $uploaded = '';
        if(!empty($upload))
        {
          $uploaded = '<p><a href="'.$upload.'" target="_blank">'.Html::img(Html::encode(Yii::$app->homeUrl.'assets/images/file.png'), ['class' => 'filedownload']).' Download file</a></p>';
        }
				//$questionlist .= '<div class="pic col-md-2">'.Html::img(MyHelpers::IdtoPic($poster), ['class' => 'freelance_profile_picture']).'</div>
        //<div class="col-md-10">
        //	<h4>'.MyHelpers::IdToName($poster) .' '. $dateposted.'</h4>
      //  </div>
      //  <div class="proposalfull">
    		//<p>'.$comment.'</p>
        //'.$uploaded.'
    	  //</div><div class="clearfix"></div>';

        $questionlist .= '
        <div '.(($c = !$c)?' id="odd"':'').' class="col-xs-12 col-sm-12 col-md-12 jobliststyle">
          <div class="col-xs-10 col-sm-10">
                 <h4>'.MyHelpers::IdToName($poster) .' '. $dateposted.'<h4>
          </div>

          <div class="clearfix"></div>
          <div class="col-xs-1 col-sm-1">
                '.Html::img(MyHelpers::IdtoPic($poster), ['class' => 'minipic']).'
          </div>
          <div class="col-xs-7 col-sm-7">
          <div class="username">
                '.Html::encode($comment).'
          </div>
          <div class="country">
                '.$uploaded.'
          </div>
          </div>
        </div>';

         //here we  need to list the qustions properly formatted
			}

        return $this->render('@app/views/templates/jobproposalsview', [
      'model' => $model,
			'questionlist' => $questionlist,
			'postcomment' => $postcomment,
        ]);
    }

	public function actionAccept($id)
    {
		$model = $this->findModel($id);
		$model2 = new Job();

		Yii::$app->db->createCommand('UPDATE {{%job_proposals}} SET declined=1 WHERE job_id='.$model->job_id.' AND id<>'.$id)->execute();
		Yii::$app->db->createCommand('UPDATE {{%job_proposals}} SET accepted=1 WHERE id='.$id)->execute();
		Yii::$app->db->createCommand('UPDATE {{%job}} SET freelancer='.$model->user_id.' WHERE id= '.$model->job_id)->execute();




		//$sellersums = HourliesSales::find()->where(['seller_id'=>yii::$app->user->identity->id])->andWhere(['paid_status' => 'Pending']);

        return $this->render('@app/views/templates/jobproposalpayment', [
            'model' => $model,
			'model2' => $model2,
        ]);
    }

	public function actionJobpayment()
	{
		$model = new Job();
        $paypal = new MatthuffyPaypal();


			$request = Yii::$app->request;
            $details = $request->post('Job');

            $clientId = MyHelpers::PayPalAuth();
            $clientSecret = MyHelpers::PayPalSecret();
            $agreementSucess = Url::home(true).'job-proposals/depositsuccess?success=true';
            $agreementCancelled = Url::home(true).'job-proposals/depositsuccess?success=false';
			$paypal->setPPcreds($clientId, $clientSecret, MyHelpers::PayPalEnvironment(), $agreementSucess, $agreementCancelled);
			 $purchaseDetails = array(
          'itemName' => 'job',
          'currency' => MyHelpers::Currency(),
          'quantity' => '1',
          'SKU' => 'test',
          'price' => $details['agreed_price'],
          'shipping' => '0',
          'tax' => '0',
          'subtotal' => $details['agreed_price'],
          'total' => $details['agreed_price'],
          'description' => MyHelpers::WebsiteName(),
          );

                $return = $paypal->paypalPayment($purchaseDetails);
                $payid = $return->getId();

				Yii::$app->db->createCommand('UPDATE {{%job}} SET buyer_paypal_auth="'.$payid.'", agreed_price="'.$details['agreed_price'].'", our_commission="'.$details['our_commission'].'", totalaftercommission="'.$details['totalaftercommission'].'" WHERE id='.$details['id'].' ')->execute();

                $link = $return->getApprovalLink();
                echo $link;

                return $this->redirect($link);


	}

	public function actionDepositsuccess()
	{
		$model = new Job();

		 $get = Yii::$app->request->get();
        if ($get['success'] == 'true') {
            $paymentID = $get['paymentId'];
            $token = $get['token'];
            $payerid = $get['PayerID'];
            $transaction_details = Job::find()->where(['buyer_paypal_auth' => $paymentID])->one();
			$job_id = $transaction_details['id'];


			Yii::$app->db->createCommand('UPDATE {{%job}} SET paid=1, isEscro=1 WHERE id= '.$job_id)->execute();

			Yii::$app->db->createCommand()->insert('{{%jobworkstream}}', [
			  'job_id' => $job_id,
			  'freelancer_id' => $transaction_details['freelancer'],
			  'user_id' => $transaction_details['user_id'],
        	])->execute();

          return $this->redirect(['jobworkstream/'.$job_id]);
		}
	}
    /**
     * Creates a new JobProposals model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new JobProposals();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/job/'.$model->job_id]);
        } else {
            return $this->render('@app/views/templates/jobproposalscreate', [
                'model' => $model,

            ]);
        }
    }

    /**
     * Updates an existing JobProposals model.
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
            return $this->redirect(['jobproposalview', 'id' => $model->id]);
        } else {
            return $this->render('@app/views/templates/jobproposalsupdate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing JobProposals model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['jobproposal']);
    }

    /**
     * Finds the JobProposals model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return JobProposals the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JobProposals::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
