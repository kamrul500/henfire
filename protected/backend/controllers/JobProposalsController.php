<?php

namespace backend\controllers;

use Yii;
use app\models\Job;
use app\models\JobProposals;
use app\models\JobProposalsSearch;
use app\models\JobQuestions;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Symfony\Component\Intl\Intl;
use common\components\MyHelpers;

/**
 * JobProposalsController implements the CRUD actions for JobProposals model.
 */
class JobProposalsController extends Controller
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
     * Lists all JobProposals models.
     * @return mixed
     */
    public function actionIndex()
    {
      if(!Yii::$app->user->identity->isAdmin)
  		{
  			Yii::$app->user->logout();
  			 return $this->goHome();
  		}
      $Job_proposals = JobProposals::find()->all();
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
        $allproposals .= '
        <tr>
          <td>'.MyHelpers::JobIdtoName($prop['job_id']).'</td>
          <td>'.MyHelpers::IdToName($prop['user_id']).'</td>
          <td>'.Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()).' '.$prop['price'].'</td>
          <td>'.$state.'</td>
          <td>'.$prop['delivery_time'].' '.Yii::t('backend', 'Days').'</td>
          <td>'.$prop['date'].'</td>
          <td><a href="job-proposals/view?id='.$prop['id'].'">
            <i class="fa fa-eye" aria-hidden="true"></i>
          </a></td>
        </tr>
        ';
      }

        return $this->render('index', [
            'allproposals' => $allproposals,

        ]);
    }

    /**
     * Displays a single JobProposals model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      $model = $this->findModel($id);
      $jobdetails = Job::find()->where(['id' => $model->job_id])->one();

      $Questions = JobQuestions::find()->where(['job_proposal_id' => $model->id])->all();
      foreach($Questions as $key)
      {
        $poster = $key['user_id'];
        $question = $key['question'];
        $upload = $key['upload'];
        $date = $key['request_date'];
        $isupload = '';
        if(!empty($upload))
        {
            $isupload = '<br>
            <a href="'.$upload.'" target="_blank"><img src="/assets/images/file.png" alt="..." height="50px" class="margin"></a>';
        }

        $comments .= '
        <li>
          <i class="fa "><img class="img-circle img-bordered-sm" src="'.MyHelpers::IdtoPic($poster).'" height="30" alt="user image"></i>

          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> '.Yii::t('backend', 'Sent').' - '.$date.'</span>

            <h3 class="timeline-header"><a href="#">'.MyHelpers::IdToFullName($poster).'</a> '.Yii::t('backend', 'replied').'</h3>

            <div class="timeline-body">
              '.$question.'
            </div>
             <div class="timeline-footer">
              '.$isupload.'
            </div>
          </div>
        </li>
        ';
      }
        return $this->render('view', [
            'model' => $model,
            'jobdetails' => $jobdetails,
            'comments' => $comments,
        ]);
    }

    /**
     * Creates a new JobProposals model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new JobProposals();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing JobProposals model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing JobProposals model.
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
     * Finds the JobProposals model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JobProposals the loaded model
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
