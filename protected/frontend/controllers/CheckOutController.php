<?php

namespace frontend\controllers;

use Yii;
use app\models\HourliesSales;
use app\models\Hourlie;
use app\models\Cardpayment;
use app\models\Hourlieworkstream;
use matthuffy\MatthuffyPaypal\MatthuffyPaypal;
use yii\helpers\Url;
use yii\helpers\Json;
use common\components\MyHelpers;

class CheckOutController extends \yii\web\Controller
{
  public function actionMyhourlieview($id)
  {
    $model = new HourliesSales();
    return $this->render('@app/views/my-hourlies/view', [
          'model' => $this->findModel($id),
      ]);
  }
    public function actionPayment()
    {
      if (Yii::$app->user->isGuest) {
          $this->redirect(Yii::$app->urlManager->createUrl('user/login'));

          return true;
      }
        $model = new HourliesSales();

        return $this->render('@app/views/check-out/checkout', array('model' => $model));
    }

    public function actionIndex()
    {
      $current_user=Yii::$app->user->identity->id;
      $session = Yii::$app->session;
      $session['userView'] = [
              'user' => $current_user,
              'returnURL' => Yii::$app->request->url,
              ];
        if (Yii::$app->user->isGuest) {
            $this->redirect(Yii::$app->urlManager->createUrl('user/register'));

            return true;
        }

        return $this->render('index');
    }

    public function actionDopayment()
    {
        $model = new HourliesSales();
        $paypal = new MatthuffyPaypal();
        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post('HourliesSales');

            $clientId = MyHelpers::PayPalAuth();
            $clientSecret = MyHelpers::PayPalSecret();
            $agreementSucess = Url::home(true).'check-out/paymentsuccess?success=true';
            $agreementCancelled = Url::home(true).'check-out/paymentsuccess?success=false';

            $purchaseDetails = array(
          'itemName' => $post['item_name'],
          'currency' => $post['buyers_currency'],
          'quantity' => $post['amount_bought'],
          'SKU' => $post['custom_trans_id'],
          'price' => $post['cost'],
          'shipping' => '0',
          'tax' => '0',
          'subtotal' => $post['total_cost'],
          'total' => $post['total_cost'],
          'description' => $post['item_name'],
          );
            $paypal->setPPcreds($clientId, $clientSecret, MyHelpers::PayPalEnvironment(), $agreementSucess, $agreementCancelled);
            if ($post['payment_type'] == 'PayPal') {
                $return = $paypal->paypalPayment($purchaseDetails);
                $payid = $return->getId();
                $model->buyer_paypal_auth = $payid;
                $model->save();
                $link = $return->getApprovalLink();
                echo $link;

                return $this->redirect($link);
            } elseif ($post['payment_type'] == 'CardPayment') {
                $cardpaymentmodel = new Cardpayment();
                $model->save();
                $purchaseDetails = json::encode($purchaseDetails);

                return $this->render('@app/views/my-hourlies/cardpayment', [
                'purchaseDetails' => $purchaseDetails, 'model' => $model, 'customid' => $post['custom_trans_id'], 'paypal' => $paypal, 'cardpaymentmodel' => $cardpaymentmodel,
            ]);
            }
        } else {
            return $this->redirect(['./hourlies/?sort=-promoted']);
        }
    }
    public function actionCardpayment($id)
    {
        $model = $this->findModel($id);
        $paypal = new MatthuffyPaypal();
      //if ($model->load(Yii::$app->request->post())) {
        $post = Yii::$app->request->post('cardpayment');
        $purchasejson = json::decode($post['purchasedetails']);
        $purchaseDetails = $purchasejson;
        $cardType = MyHelpers::detectCardType($_POST['cardNumber']);
        $getFirstLastname = MyHelpers::doSplitName($_POST['cardholder']);
        $CardDetails = array(
         'Type' => $cardType,
         'cardNumber' => $_POST['cardNumber'],
         'expMonth' => $_POST['expMonth'],
         'expYear' => $_POST['expYear'],
         'ccV2' => $_POST['ccV2'],
         'cardFname' => $getFirstLastname['first'],
         'cardLname' => $getFirstLastname['last'],
         'Email' => $post['email'],
        );
        $clientId = MyHelpers::PayPalAuth();
        $clientSecret = MyHelpers::PayPalSecret();
        $agreementSucess = 'none';
        $agreementCancelled = 'none';
        $paypal->setPPcreds($clientId, $clientSecret, MyHelpers::PayPalEnvironment(), $agreementSucess, $agreementCancelled);
        $savedcard = $paypal->ccvault($CardDetails);
        $agreement = $paypal->paymentSavedCard($purchaseDetails, $savedcard);
        $agreement_decoded = json::decode($agreement, true);

        $model->buyer_card_vault = $agreement_decoded['payer']['funding_instruments'][0]['credit_card_token']['credit_card_id'];
        $model->buyer_transaction_code = $agreement_decoded['id'];
        $model->paid_status = $agreement_decoded['state'];
        if ($model->paid_status == 'approved') {
            $model->isEscro = 1;
            Yii::$app->db->createCommand()->insert('{{%hourlieworkstream}}', [
              'job_id' => $id,
              'freelancer_id' => $transaction_details['seller_id'],
              'user_id' => $transaction_details['buyer_id'],
            ])->execute();

        }
        $model->save();

        return $this->render('@app/views/my-hourlies/view', [
            'model' => $this->findModel($id),
        ]);
      //}
      //else {
          //return $this->redirect(['./hourlies/?sort=-promoted']);
      //}
    }
    public function actionPaymentsuccess()
    {
        $model = new HourliesSales();

        $get = Yii::$app->request->get();
        if ($get['success'] == 'true') {
            $paymentID = $get['paymentId'];
            $token = $get['token'];
            $payerid = $get['PayerID'];
            $transaction_details = HourliesSales::find()->where(['buyer_paypal_auth' => $paymentID])->one();

            $purchaseDetails = array(
        'itemName' => $transaction_details['item_name'],
        'currency' => $transaction_details['buyers_currency'],
        'quantity' => $transaction_details['amount_bought'],
        'SKU' => $transaction_details['custom_trans_id'],
        'price' => $transaction_details['cost'],
        'shipping' => '0',
        'tax' => '0',
        'subtotal' => $transaction_details['total_cost'],
        'total' => $transaction_details['total_cost'],
        'description' => $transaction_details['item_name'],
        );

            $clientId = MyHelpers::PayPalAuth();
            $clientSecret = MyHelpers::PayPalSecret();
            $agreementSucess = 'none';
            $agreementCancelled = 'none';

        $paypal = new MatthuffyPaypal();
        $paypal->setPPcreds($clientId, $clientSecret, MyHelpers::PayPalEnvironment(), $agreementSucess, $agreementCancelled);
        $paypal->executePayment('true', $paymentID, $payerid, $purchaseDetails);
        $id = $transaction_details['id'];

        Yii::$app->db->createCommand('UPDATE {{%hourliessales}} SET 	paid_status="Success", isEscro=1 WHERE id= '.$id)->execute();
        $string = preg_replace("/[^\w]+/", '-', $transaction_details['item_name']);
        $SeoURL = strtolower($string);

        Yii::$app->db->createCommand()->insert('{{%hourlieworkstream}}', [
          'job_id' => $id,
          'freelancer_id' => $transaction_details['seller_id'],
          'user_id' => $transaction_details['buyer_id'],
        ])->execute();

        Yii::$app->mailer->compose()
          ->setTo(Yii::$app->user->identity->email)
          ->setFrom([MyHelpers::WebsiteEmail() => MyHelpers::WebsiteName()])
          ->setSubject(Yii::t('frontend','Purchase Successful'))
          ->setTextBody('You have received a new purchase')
          ->setHtmlBody('<b>Dear '.Yii::$app->user->identity->username.'</b>
          <br />
          Your purchase of
          <br /><b>'.$transaction_details['amount_bought'].'x '.$transaction_details['item_name'].'</b>
          <br />Price: '.$transaction_details['total_cost'].'
          <br />Transaction ID:'.$transaction_details['custom_trans_id'].'
          <br />has been successful.<br />
          Please communicate with the freelancer to complete your hourlie.
          ')
          ->send();

            return $this->redirect(['/dashboard']);
        }
        else {
          $paymentID = $get['paymentId'];
          $token = $get['token'];
          $payerid = $get['PayerID'];
          $transaction_details = HourliesSales::find()->where(['buyer_paypal_auth' => $paymentID])->one();
          $id = $transaction_details['id'];
          Yii::$app->db->createCommand('UPDATE {{%hourliessales}} SET 	paid_status="Failed", buyer_cancelled=1, isEscro=0 WHERE id= '.$id)->execute();
        }
    }

    protected function findModel($id)
    {
        if (($model = HourliesSales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
