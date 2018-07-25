<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use app\models\Job;
use app\models\Jobworkstream;
use app\models\Jobworkflow;
use frontend\models\JobworkstreamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use yii\web\UploadedFile;
use yii\helpers\Url;

/**
 * JobworkstreamController implements the CRUD actions for Jobworkstream model.
 */
class JobworkstreamController extends Controller
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
     * Lists all Jobworkstream models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JobworkstreamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Jobworkstream model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      $model = $this->findModel($id);
      //manage comments and perform upload of of files
      $postcomment = new Jobworkflow();
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

        Yii::$app->db->createCommand()->insert('{{%jobworkflow}}', [
            'workstream' => $id,
            'user_id' => Yii::$app->user->getId(),
            'comment' => $postcomment->comment,
            'upload' => $theupload,
        ])->execute();
      }

      //Display the Workflow data
        $jobdetails = Job::find()->where(['id'=>$id])->one();
        $jobname = $jobdetails['title'];
        $agreed_Price = $jobdetails['agreed_price'];

        $totaltofreelancer = $jobdetails['totalaftercommission'];
        $is_escrow = $jobdetails['isEscro'];
        $is_released = $jobdetails['released_escro'];
        $completed = $jobdetails['success'];
        $datecompleted = $jobdetails['date_completed'];
        $is_refunded = $jobdetails['is_refunded'];
        $freelancer_paid = $jobdetails['freelancer_paid'];
        $buyer_id = $jobdetails['user_id'];
        $seller_id = $jobdetails['freelancer'];

        $timeline = '';

        $jobmainstream = Jobworkstream::find()->where(['job_id'=>$id])->one();
        $jobworkflow = Jobworkflow::find()->where(['workstream'=>$id])->all();



        if(!empty($jobworkflow))
        {
          foreach($jobworkflow as $flow)
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
        $jobstarted = '
        <li>
          <i class="fa fa-comments bg-yellow"></i>

          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> '.Yii::t('frontend', 'Started').' - '.$model->date.'</span>

            <h3 class="timeline-header"><a href="#"> '.Yii::t('frontend', 'Project STarted').'</a></h3>

            <div class="timeline-body">
            <h4>'.$jobname.'</h4>
            </div>
             <div class="timeline-footer">
            </div>
          </div>
        </li>';

        if($isreleased == 1)
        {
          //here we will show that the funds have ben release to the freelancer

        }
        if($completed == 1)
        {
          //here we will enable a review for both freelancer and member to review each other

        }
        if($is_refunded == 1)
        {
          //here we must handle the refund part to send funds back to users acount
          //Here we will allow only the member to review the frelancer
        }


        return $this->render('view', [
            'model' => $this->findModel($id),
            'postcomment' => $postcomment,
            'jobname' => $jobname,
            'jobprice' => $agreed_Price,
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
        ]);
    }

    /**
     * Creates a new Jobworkstream model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCompleted($id)
     {
       $model = $this->findModel($id);

       $datetime = date('Y-m-d h:i:s a', time());
       Yii::$app->db->createCommand("UPDATE {{%jobworkstream}} SET is_finished=1 WHERE job_id = '$model->job_id' ")->execute();
       //Yii::$app->db->createCommand("UPDATE {{%hourliessales}} SET completed=1, date_completed='$datetime'  WHERE id = '$model->job_id' ")->execute();
       return $this->redirect(['view', 'id' => $model->job_id]);
     }
     public function actionAuthorized($id)
     {
       $model = $this->findModel($id);

       $datetime = date('Y-m-d h:i:s a', time());
       //Yii::$app->db->createCommand("UPDATE {{%hourlieworkstream}} SET is_finished=1 WHERE job_id = '$model->job_id' ")->execute();
       Yii::$app->db->createCommand("UPDATE {{%job}} SET success=1, date_completed='$datetime', released_escro=1  WHERE id = '$model->job_id' ")->execute();
       return $this->redirect(['view', 'id' => $model->job_id]);
     }
    public function actionCreate()
    {
        $model = new Jobworkstream();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->job_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Jobworkstream model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->job_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Jobworkstream model.
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
     * Finds the Jobworkstream model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Jobworkstream the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jobworkstream::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
