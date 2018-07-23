<?php

namespace backend\controllers;

use Yii;
use app\models\Hourliessales;
use app\models\Hourlieworkstream;
use app\models\Hourlieworkflow;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Symfony\Component\Intl\Intl;
use common\components\MyHelpers;

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
      if(!Yii::$app->user->identity->isAdmin)
  		{
  			Yii::$app->user->logout();
  			 return $this->goHome();
  		}
        $hourliesw = Hourlieworkstream::find()->orderBy(['date'=>SORT_DESC])->all();
        foreach ($hourliesw as $stream)
        {
          $job_id = $stream['job_id'];
          $jobName = MyHelpers::HourlieSalesIdtoName($job_id);
          $member = MyHelpers::IdToName($stream['user_id']);
          $freelancer = MyHelpers::IdToName($stream['freelancer_id']);
          $is_finished = $stream['is_finished'];
          $admin_flagged = $stream['admin_flagged'];
          $freelancer_flagged = $stream['freelancer_flagged'];
          $member_flagged = $stream['member_flagged'];
          $flagged_comment = $stream['flagged_comment'];
          $date = $stream['date'];

          $flagged = '';
          if($freelancer_flagged == 1)
          {
            $flagged = '<small class="label bg-red">Freelancer</small>';
          }
          else if($member_flagged == 1)
          {
            $flagged = '<small class="label bg-red">Member</small>';
          }
          else if($admin_flagged == 1)
          {
            $flagged = '<small class="label bg-red">Admin</small>';
          }

          $workflow = 'hourlieworkstream/view?id='.$job_id;

          if ($is_finished == 1)
          {
            $status = '<small class="label bg-green">Completed</small>';
          }
          else {
            $status = '<small class="label bg-yellow">In Progress</small>';
          }
          $table .= '
          <tr>
            <td><a href="hourlieworkstream/view?id='.$job_id.'">'.$jobName.'</a></td>
            <td>'.$freelancer.'</td>
            <td>'.$member.'</td>
            <td>'.$status.'</td>
            <td>'.$flagged.'</td>
            <td>'.$date.'</td>
            <td><a href="hourlieworkstream/view?id='.$job_id.'">
              <i class="fa fa-eye" aria-hidden="true"></i>
            </a></td>

          </tr>
          ';
        }

        return $this->render('index', [
            'table' => $table,
        ]);
    }

    /**
     * Displays a single Hourlieworkstream model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      $model = $this->findModel($id);
      $workflow = Hourlieworkflow::find()->where(['workstream' => $id])->orderBy(['date'=>SORT_DESC])->all();
      $hourlieinfo = Hourliessales::find()->where(['id' => $id])->all();
      foreach($hourlieinfo as $info)
      {
        $hourlieTitle = $info['item_name'];
        $hourlieid = $info['item_id'];
        $cost = $info['cost'];
        $total_cost = $info['total_cost'];
        $amount_bought = $info['amount_bought'];
        $paid_status = $info['paid_status'];
        $amount_bought = $info['amount_bought'];
        $completed = $info['completed'];
        $isEscro = $info['isEscro'];
        $TransactionID = $info['custom_trans_id'];
        $freelancer_paid = $info['freelancer_paid'];
      }
      $aboutHourlie = '
      <div class="box-body">
        <strong><i class="fa fa-book margin-r-5"></i> '.Yii::t('backend', 'Title').'</strong>
        <p class="text-muted">
          '.$hourlieTitle.'
        </p>

        <strong><i class="fa fa-map-marker margin-r-5"></i> '.Yii::t('backend', 'Location').'</strong>
        <p class="text-muted">'.MyHelpers::IdToCountry($model->freelancer_id).'</p>

        <strong><i class="fa fa-usd margin-r-5"></i> '.Yii::t('backend', 'Price').'</strong>
        <p class="text-muted">'.Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()) . $cost.'</p>

        <strong><i class="fa fa-file-text-o margin-r-5"></i> '.Yii::t('backend', 'Payment Information').'</strong>
        <p class="text-muted">'.Yii::t('backend', 'Bought').': '.$amount_bought.' '.Yii::t('backend', 'Hourlie').'</p>
        <p class="text-muted">'.Yii::t('backend', 'Total Price').': '.$total_cost.'</p>
        <p class="text-muted">'.Yii::t('backend', 'Payment Status').': '.$paid_status.'</p>
      </div>
      ';
      foreach ($workflow as $key)
      {
        $poster = $key['user_id'];
        $comment = $key['comment'];
        $upload = $key['upload'];
        $date = $key['date'];
        $flagged = $key['flagged'];
        $isupload = '';
        if(!empty($upload))
        {
            $isupload = '<br>
            <a href="'.$upload.'" target="_blank"><img src="/assets/images/file.png" alt="..." height="50px" class="margin"></a>';
        }
        $flaggedComment = '';
        if($flagged == 1)
        {
          $flagged_comment = $key['flagged_comment'];
          if($model->freelancer_flagged == 1)
          {
            $flaggedComment = '<a class="btn btn-danger btn-xs pull-right">'.Yii::t('backend', 'Freelancer Flagged').'</a> '.$flagged_comment;
          }
          else if($model->member_flagged == 1)
          {
              $flaggedComment = '<a class="btn btn-danger btn-xs pull-right">'.Yii::t('backend', 'Member Flagged').'</a> '.$flagged_comment;
          }
          else if($model->admin_flagged == 1)
          {
              $flaggedComment = '<a class="btn btn-danger btn-xs pull-right">'.Yii::t('backend', 'Admin Flagged').'</a> '.$flagged_comment;
          }
        }
        $comments .= '
        <li>
          <i class="fa "><img class="img-circle img-bordered-sm" src="'.MyHelpers::IdtoPic($poster).'" height="30" alt="user image"></i>

          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> '.Yii::t('backend', 'Sent').' - '.$date.'</span>

            <h3 class="timeline-header"><a href="#">'.MyHelpers::IdToFullName($poster).'</a> '.Yii::t('backend', 'replied').'</h3>

            <div class="timeline-body">
              '.$comment.'
            </div>
             <div class="timeline-footer">
              '.$isupload.'
              '.$flaggedComment.'
            </div>
          </div>
        </li>
        ';
      }
      if(empty($workflow))
      {
        $comments = '
        <li>
          <i class="fa fa-comments bg-yellow"></i>

          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> '.Yii::t('backend', 'Started').' - '.$model->date.'</span>

            <h3 class="timeline-header"><a href="#"> '.Yii::t('backend', 'Admin Notice').'</a></h3>

            <div class="timeline-body">
            '.Yii::t('backend', 'Nothing has yet been added to the work stream').'
            </div>
             <div class="timeline-footer">
            </div>
          </div>
        </li>
        ';
      }
        return $this->render('view', [
            'model' => $model,
            'comments' => $comments,
            'about' => $aboutHourlie,
        ]);
    }

    /**
     * Creates a new Hourlieworkstream model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Hourlieworkstream();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->job_id]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->job_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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
