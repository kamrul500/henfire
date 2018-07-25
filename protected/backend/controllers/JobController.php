<?php

namespace backend\controllers;

use Yii;
use app\models\Job;
use app\models\JobSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Symfony\Component\Intl\Intl;
use yii\helpers\Json;
use common\components\MyHelpers;

/**
 * JobController implements the CRUD actions for Job model.
 */
class JobController extends Controller
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
     * Lists all Job models.
     * @return mixed
     */
    public function actionIndex()
    {
      if(!Yii::$app->user->identity->isAdmin)
  		{
  			Yii::$app->user->logout();
  			 return $this->goHome();
  		}

      $Joblist = Job::find()->all();
      foreach($Joblist as $job)
      {
        $id = $job['id'];
        $title = $job['title'];
        $user = $job['user_id'];
        $category = $job['category'];
        $date_created = $job['date_created'];
        $date_expire = $job['date_expire'];
        $budget = $job['budget'];
        $promoted = $job['promoted'];
        $paid = $job['paid'];
        $completed = $job['success'];
        $freelancer = $job['freelancer'];
        $isEscro = $job['isEscro'];
        $freelancer_paid = $job['freelancer_paid'];
        $released_escro = $job['released_escro'];
        $buyer_cancelled = $job['buyer_cancelled'];
        $seller_cancelled = $job['seller_cancelled'];
        $user = $job['user_id'];

        if($paid == 0)
        {
          $status = '<small class="label bg-blue">'.Yii::t('backend', 'Waiting Offers').'</small>';
        }
        if($paid == 0 && $freelancer >= 1)
        {
          $status = '<small class="label bg-red">'.Yii::t('backend', 'Pending Payment').'</small>';
        }
        elseif($paid == 1)
        {
          $status = '<small class="label bg-yellow">'.Yii::t('backend', 'In Progress').'</small>';
        }
        if($completed == 1)
        {
          $status = '<small class="label bg-green">'.Yii::t('backend', 'Completed').'</small>';
        }
        if($freelancer_paid == 1)
        {
          $status = '<small class="label bg-blue">'.Yii::t('backend', 'Frelncer paid').'</small>';
        }

        $ispromoted = 'No';
        if($promoted == 1)
        {
          $ispromoted = 'Prmoted';
        }

        $isinescro = 'No';
        if($isEscro == 1)
        {
          $isinescro = 'Yes';
        }

        $issues = 'No';
        if($buyer_cancelled == 1 || $seller_cancelled == 1)
        {
          $issues = 'yes';
        }
        $table .= '
        <tr>
          <td><a href="jobworkstream/view?id='.$id.'">'.$title.'</a></td>
          <td>'.$status.'</td>
          <td>'.MyHelpers::IdToName($user).'</td>
          <td>'.MyHelpers::IdToName($freelancer).'</td>
          <td>'.Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()).' '.$budget.'</td>
          <td>'.$category.'</td>
          <td>'.$date_created.'</td>
          <td>'.$date_expire.'</td>
          <td>'.$ispromoted.'</td>
          <td>'.$isinescro.'</td>
          <td>'.$issues.'</td>
          <td><a href="jobworkstream/view?id='.$id.'">
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
     * Displays a single Job model.
     * @param integer $id
     * @param integer $user_id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Job model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Job();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Job model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $user_id
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
     * Deletes an existing Job model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $user_id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Job model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $user_id
     * @return Job the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Job::findOne(['id' => $id])) !== null) {
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
                $out = Job::getSub($cat_id);
                echo Json::encode(['output' => $out, 'selected' => '']);

                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }
}
