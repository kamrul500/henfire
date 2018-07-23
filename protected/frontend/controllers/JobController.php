<?php

namespace frontend\controllers;

use Yii;
use app\models\Job;
use app\models\JobSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\JobProposals;
use common\components\MyHelpers;
use app\models\User;

/**
 * JobController implements the CRUD actions for Job model.
 */
class JobController extends Controller
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
     * Lists all Job models.
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
        $searchModel = new JobSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('@app/views/templates/job', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Job model.
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
      $proposals = JobProposals::find()->where(['job_id' => $model->id])->all();
      $myproposals = count($proposals);
      $string = preg_replace("/[^\w]+/", '-', $model->title);
      $SeoURL = strtolower($string);
      $proposal_user = '';
      $material = json_decode($model->material);
      $edit='';
      $i = 0;
      if(!empty( $material))
      {
         foreach ($material as $file) {
             if (!empty($file)) {
              $materialdownload .= '<a href="'.$file.'" download> '.$file.'</a>';
             }
         }
      }
      $userdetails = User::find()->where(['id' => $model->user_id])->all();
      foreach($userdetails as $userdata)
      {
        $memberfullname = $userdata['full_name'];
        $memberprofile_pic = $userdata['profile_picture'];
        $memberoccupation = $userdata['occupation'];
        $memberintroduction = $userdata['introduction'];
        $membercountry = $userdata['country'];
        $membercurrency = $userdata['currency'];
        $memberrating = $userdata['rating'];
        $memberfull_name = preg_replace("/[^\w]+/", '-', $userdata['full_name']);
      }
      foreach ($proposals as $data) {
          $name = Yii::$app->db->createCommand('SELECT * FROM {{%user}} WHERE id="'.$data['user_id'].'"');
          $reader = $name->query();
          $dataUser = $reader->readAll();
          $profile_pic = $dataUser[0]['profile_picture'];
          $full_name = preg_replace("/[^\w]+/", '-', $dataUser[0]['full_name']);
          $proposal_user .= '<a href="../profile/'.$full_name.'-'.$data['user_id'].'">'.Html::img($profile_pic, ['class' => 'timelinepic']).'</a> ';
          if (++$i > 6) {
              break;
          }
      }
      $proposalcount = '';
      if ($myproposals > 7) {
          $newpropcount = $myproposals - 7;
          $proposalcount = '+'.$newpropcount.' proposals';
      }
      if ($myproposals == 0)
      {
        $listedprops = Yii::t('frontend', 'Why not be the first to send <a href="#target">proposal</a>');
      }
      else
      {
        $listedprops = $proposal_user.'<span>'. $proposalcount . Yii::t('frontend', 'Have already sent a proposal.').'</span>';
      }
      if ($model->experience_level == 1) {
          $setlevel = Yii::t('frontend', 'Entry');
      } elseif ($model->experience_level == 2) {
          $setlevel = Yii::t('frontend', 'Intermediate');
      } elseif ($model->experience_level == 3) {
          $setlevel = Yii::t('frontend', 'Expert');
      }
      $timeago = MyHelpers::timeAgo($model->date_created);
      $createproposal='';
      $chatworkflow = '';
      if (Yii::$app->user->isGuest) {
          $createproposal = '<div class="col-md-12">You must be a member to create a proposal <a href="../site/signup">Sign up</a></div>';
      } else {
          $user_id = Yii::$app->user->identity->id;
          $userproposals = JobProposals::find()->where(['user_id' => $user_id, 'job_id' => $model->id])->all();

      }


      $edit ='';

      if($model->user_id == Yii::$app->user->identity->id)
      {
      $edit = Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
      }
        return $this->render('@app/views/templates/jobview', [
            'model' => $model,'timeago' => $timeago,
            'myproposals' => $myproposals, 'proposal_user' => $proposal_user,
            'proposalcount' => $proposalcount, 'setlevel' => $setlevel,
            'chatworkflow' => $chatworkflow,
            'materialdownload' => $materialdownload,
            'edit' => $edit,
            'memberprofile_pic' => $memberprofile_pic,
            'memberfull_name' => $memberfull_name,
            'membercountry' => $membercountry,
            'memberrating' => $memberrating,
            'memberintroduction' => $memberintroduction,
            'memberoccupation' => $memberoccupation,
            'listedprops' => $listedprops,

        ]);
    }

    /**
     * Creates a new Job model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionNew()
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
        $model = new Job();
        if ($model->mymaterial = UploadedFile::getInstances($model, 'mymaterial')) {
            $array = array();
            foreach ($model->mymaterial as $images) {
                $randname3 = Yii::$app->security->generateRandomString();
                $images->saveAs(Yii::getAlias('@uploads').'/' .$randname3.'.'.$images->extension);
                $array[] .= Url::base().'/uploads/'.$randname3.'.'.$images->extension;
            }
            //$splitted = explode(",", $array);
            //$portfolio = json_decode(json_encode($splitted), true);
            $model->material = json::encode(array_values($array));
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          $string = preg_replace("/[^\w]+/", '-', $model->title);
          $SeoURL = strtolower($string);
            return $this->redirect(['job/'.$SeoURL.'-'.$model->id]);
        } else {
            return $this->render('@app/views/templates/jobcreate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Job model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->mymaterial = UploadedFile::getInstances($model, 'mymaterial')) {
            $array = '';
            foreach ($model->mymaterial as $images) {
                $randname3 = Yii::$app->security->generateRandomString();
                $images->saveAs(Yii::getAlias('@uploads').'/' .$randname3.'.'.$images->extension);
                $array[] .= Url::base().'/uploads/'.$randname3.'.'.$images->extension;
            }
            //$splitted = explode(",", $array);
            //$portfolio = json_decode(json_encode($splitted), true);
            $model->material = json::encode(array_values($array));
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          $string = preg_replace("/[^\w]+/", '-', $model->title);
          $SeoURL = strtolower($string);
            return $this->redirect(['job/'.$SeoURL.'-'.$id]);
        } else {
            return $this->render('@app/views/templates/jobupdate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Job model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['job']);
    }

    /**
     * Finds the Job model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return Job the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Job::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSubcat()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = \app\models\Job::getSub($cat_id);
                echo Json::encode(['output' => $out, 'selected' => '']);

                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }
}
