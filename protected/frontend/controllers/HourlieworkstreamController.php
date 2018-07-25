<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use app\models\HourliesSales;
use app\models\Hourlieworkstream;
use frontend\models\HourlieworkstreamSearch;
use app\models\Hourlieworkflow;
use app\models\HourlieworkflowSearch;
use app\models\HourliesReviews;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Userreviews;

/**
 * HourlieworkstreamController implements the CRUD actions for Hourlieworkstream model.
 */
class HourlieworkstreamController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Hourlieworkstream models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HourlieworkstreamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hourlieworkstream model.
     * @param integer $id
     * @return mixed
     */
     //Hourlie has been completed by the Freelancer clicking complete. lets do that here
    public function actionCompleted($id)
    {
      $model = $this->findModel($id);

      $datetime = date('Y-m-d h:i:s a', time());
      Yii::$app->db->createCommand("UPDATE {{%hourlieworkstream}} SET is_finished=1 WHERE job_id = '$model->job_id' ")->execute();
      //Yii::$app->db->createCommand("UPDATE {{%hourliessales}} SET completed=1, date_completed='$datetime'  WHERE id = '$model->job_id' ")->execute();
      return $this->redirect(['view', 'id' => $model->job_id]);
    }
    public function actionAuthorized($id)
    {
      $model = $this->findModel($id);

      $datetime = date('Y-m-d h:i:s a', time());
      //Yii::$app->db->createCommand("UPDATE {{%hourlieworkstream}} SET is_finished=1 WHERE job_id = '$model->job_id' ")->execute();
      Yii::$app->db->createCommand("UPDATE {{%hourliessales}} SET completed=1, date_completed='$datetime', released_escro=1  WHERE id = '$model->job_id' ")->execute();
      return $this->redirect(['view', 'id' => $model->job_id]);
    }

    public function actionView($id)
    {


      $model = $this->findModel($id);

      $postcomment = new Hourlieworkflow();
      $identity = Yii::$app->user->identity->id;

      if(!($identity == $model->freelancer_id || $identity == $model->user_id)){
        $this->redirect(Yii::$app->urlManager->createUrl('/'));
        return true;
      }

      if($identity == $model->freelancer_id)
      {
        $idtoshow = $model->user_id;
      }
      else {
        $idtoshow = $model->freelancer_id;
      }

      $hourliedetails = HourliesSales::find()->where(['id'=>$id])->one();
      $item_id = $hourliedetails['item_id'];
      $hourliename = $hourliedetails['item_name'];
      $hourlieprice = $hourliedetails['total_cost'];
      $totaltofreelancer = $hourliedetails['totalaftercommission'];
      $is_escrow = $hourliedetails['isEscro'];
      $is_released = $hourliedetails['released_escro'];
      $completed = $hourliedetails['completed'];
      $datecompleted = $hourliedetails['date_completed'];
      $is_refunded = $hourliedetails['is_refunded'];
      $freelancer_paid = $hourliedetails['freelancer_paid'];
      $buyer_id = $hourliedetails['buyer_id'];
      $seller_id = $hourliedetails['seller_id'];

      $timeline = '';

      $hourliemainstream = Hourlieworkstream::find()->where(['job_id'=>$id])->one();


      $hourlieworkflow = Hourlieworkflow::find()->where(['workstream'=>$id])->all();

      $Hourliefinished = '';

      if($model->is_finished == 1)
      {
        $Hourliefinished = '<li>
          <i class="fa fa-handshake-o bg-green"></i>

          <div class="timeline-item ">

            <h2 class="timeline-header">'.Yii::t('frontend', 'Hourlie Finished').'</h2>

            <div class="timeline-body">
            <h4>'.Yii::t('backend', 'I have finished this Hourlie, Please release the Escrow').'</h4>
            </div>
             <div class="timeline-footer">
            </div>
          </div>
        </li>';
      }

      if(!empty($hourlieworkflow))
      {
        foreach($hourlieworkflow as $flow)
        {
          $poster = $flow['user_id'];
          $dateposted = $flow['date'];
          $comment = $flow['comment'];
          $upload = $flow['upload'];
          $profilepic = User::find(['profile_picture'])->where(['id' => $poster])->one();
          $fullname = User::find(['full_name'])->where(['id' => $poster])->one();
          $uploaded = '';
          if(!empty($upload))
          {
            $uploaded = '<p><a href="'.$upload.'" target="_blank">'.Html::img(Html::encode(Yii::$app->homeUrl.'assets/images/file.png'), ['class' => 'filedownload']).' Download file</a></p>';
          }



          $timeline .= '
          <li>
            <i class="fa "><img class="img-circle img-bordered-sm" src="'.$profilepic['profile_picture'].'" height="30" alt="user image"></i>

            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> '.Yii::t('frontend', 'Sent').' - '.$dateposted.'</span>

              <h3 class="timeline-header"><a href="#">'.$fullname['full_name'].'</a> '.Yii::t('backend', 'replied').'</h3>

              <div class="timeline-body">
                '.$comment.'
              </div>
               <div class="timeline-footer">
                '.$uploaded   .'
              </div>
            </div>
          </li>
          ';
        }

      }
      if(empty($hourlieworkflow))
      {
        $timeline = '
        <li>
          <i class="fa fa-comments bg-yellow"></i>

          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> '.Yii::t('frontend', 'Started').' - '.$model->date.'</span>

            <h3 class="timeline-header"><a href="#"> '.Yii::t('frontend', 'Admin Notice').'</a></h3>

            <div class="timeline-body">
            '.Yii::t('backend', 'Nothing has yet been added to the work stream').'
            </div>
             <div class="timeline-footer">
            </div>
          </div>
        </li>
        ';
      }

      $jobstarted = '
      <li>
        <i class="fa fa-comments bg-yellow"></i>

        <div class="timeline-item">
          <span class="time"><i class="fa fa-clock-o"></i> '.Yii::t('frontend', 'Started').' - '.$model->date.'</span>

          <h3 class="timeline-header"><a href="#"> '.Yii::t('frontend', 'Project STarted').'</a></h3>

          <div class="timeline-body">
          <h4>'.$hourliename.'</h4>
          </div>
           <div class="timeline-footer">
          </div>
        </div>
      </li>';


      $hourliereview = HourliesReviews::find()->where(['job_id'=>$id])->one();
      $review = $hourliereview['comment'];
      $reviewreply = $hourliereview['reply'];
      $rating = $hourliereview['reting'];
      $reviewdate = $hourliereview['date'];


      if($isreleased == 1)
      {
        //here we will show that the funds have ben release to the freelancer

      }
      if($completed == 1)
      {
        $activetimeline = '';
        $activereview = 'active';
      }
      else {
        $activetimeline = 'active';
        $activereview = '';
      }
      if($is_refunded == 1)
      {
        //here we must handle the refund part to send funds back to users acount
        //Here we will allow only the member to review the frelancer
      }
      $thereview = new HourliesReviews();
      $userreviewmodel = new Userreviews();
        return $this->render('view', [
            'model' => $model,
            'postcomment' => $postcomment,
            'hourliename' => $hourliename,
            'hourlieprice' => $hourlieprice,
            'totaltofreelancer' => $totaltofreelancer,
            'is_escrow' => $is_escrow,
            'is_released' => $is_released,
            'completed' => $completed,
            'datecompleted' => $datecompleted,
            'is_refunded' => $is_refunded,
            'hourlieworkflow' => $hourlieworkflow,
            'poster' => $poster,
            'dateposted' => $dateposted,
            'comment' => $comment,
            'upload' => $upload,
            'timeline' => $timeline,
            'jobstarted' => $jobstarted,
            'idtoshow' => $idtoshow,
            'Hourliefinished' => $Hourliefinished,
            'activetimeline' => $activetimeline,
            'activereview' => $activereview,
            'thereview' => $thereview,
            'item_id' => $item_id,
            'buyer_id' => $buyer_id,
            'seller_id' => $seller_id,
            'userreview' => $userreviewmodel,

        ]);
    }

    /**
     * Creates a new Hourlieworkstream model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Hourlieworkflow();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Hourlieworkstream model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $postcomment = new Hourlieworkflow();

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

          Yii::$app->db->createCommand()->insert('{{%hourlieworkflow}}', [
              'workstream' => $id,
              'user_id' => Yii::$app->user->getId(),
              'comment' => $postcomment->comment,
              'upload' => $theupload,
          ])->execute();
        }
        return $this->redirect(['view', 'id' => $model->job_id]);
    }

    /**
     * Deletes an existing Hourlieworkstream model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Hourlieworkstream model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Hourlieworkstream the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hourlieworkstream::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
