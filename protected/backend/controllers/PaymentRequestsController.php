<?php

namespace backend\controllers;
use Yii;
use app\models\PaymentRequests;
use Symfony\Component\Intl\Intl;
use yii\web\NotFoundHttpException;
use common\components\MyHelpers;
use yii\helpers\Html;

class PaymentRequestsController extends \yii\web\Controller
{
    public function actionIndex()
    {
      $model = new PaymentRequests();
      $requests = PaymentRequests::find()->all();

      foreach ($requests as $key => $value) {
        $sum = $requests[$key]['sum'];
        if(!empty($requests[$key]['job_id']))
        {
          $type = 'Job';
          $id = $requests[$key]['job_id'];
        }
        else {
          $type = 'Hourlie';
          $id = $requests[$key]['hourlie_id'];
        }
        if($requests[$key]['paid'] == 0)
        {
          $withdraw = Html::a('Pay Freelancer', ['payment-requests/withdraw/', 'id' => $requests[$key]['id'], 'type' => $type, 'sum' => $sum, 'work_id' => $id], ['class' => 'btn btn-warning']);
        }
        if($requests[$key]['paid'] == 1){
          $withdraw = '<small class="label bg-green-active color-palette">'.Yii::t('frontend', 'Paid Out').'</small>';
        }

        $PaymentsTable .= '
        <tr>
          <td>'.MyHelpers::IdToName($requests[$key]['user_id']).'</td>
          <td>'.$type . $id.'</td>
          <td>'.Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency()) . $sum.'</td>
          <td>PayPal</td>
          <td>'.MyHelpers::IdToPayPalEmail($requests[$key]['user_id']).'</td>
          <td>'.$withdraw.'</td>
        </tr>
        ';
      }
      return $this->render('index', [
          'model' => $model,
          'PaymentsTable' => $PaymentsTable,
      ]);
    }

    public function actionWithdraw($id)
    {
      $request = Yii::$app->request;
      $id = $request->get('id');
      $work_id = $request->get('work_id');
      $type = $request->get('type');
      $model = $this->findModel($id);
      $model->paid = '1';
      $model->save();

      if($type == 'Job')
      {
        Yii::$app->db->createCommand("UPDATE {{%job}} SET freelancer_paid=1 WHERE id = '$work_id' ")->execute();
      }
      else {
        Yii::$app->db->createCommand("UPDATE {{%hourliessales}} SET freelancer_paid=1 WHERE id = '$work_id' ")->execute();
      }

      return $this->redirect('/admin/index.php/payment-requests');
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
        if (($model = PaymentRequests::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
