<?php

namespace frontend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\Html;
use common\components\MyHelpers;
use app\models\PaymentRequests;
use app\models\User;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Job;
use app\models\HourliesSales;

/**
 * JobController implements the CRUD actions for Job model.
 */
class WithdrawController extends Controller
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
      $model = new PaymentRequests();
      $userid = Yii::$app->user->identity->id;
      $id =Yii::$app->request->queryParams['id'];
      $type = Yii::$app->request->queryParams['type'];
      $sum = Yii::$app->request->queryParams['sum'];
      if($type == 'Hourlie')
      {

        $hourlie = HourliesSales::find()->where(['id'=> $id])->one();

        $model->user_id = $userid;
        $model->sum = $sum;
        $model->hourlie_id = $id;
        $model->withdraw_method = 'PayPal';
        $model->save();
      }
      else {
        $hourlie = Job::find()->where(['id'=> $id])->one();
        $model->user_id = $userid;
        $model->sum = $sum;
        $model->job_id = $id;
        $model->withdraw_method = 'PayPal';
        $model->save();
      }

        return $this->redirect('/payments');
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


}
