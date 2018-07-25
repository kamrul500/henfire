<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Hourlies;
use app\models\Job;
use app\models\User;
use yii\helpers\ArrayHelper;
use common\components\MyHelpers;

class PromoteController extends \yii\web\Controller
{
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
    $model = new Hourlies();

    $userid = Yii::$app->user->identity->id;

    $items = Hourlies::find()->where(['user_id' => Yii::$app->user->identity->id])->andwhere(['dissabled' => 0])->all();
    $result = array();
    $result2 = array();
    foreach($items as $key)
    {
      $image = json_decode($key['images']);
      $mainIMG = $image[0];
      $result[] = array('id' => $key['id'], 'name' => $mainIMG);
      if($key['promoted'] == 1)
      {
        $result2[] .= $key['id'];
      }
    }


      return $this->render('@app/views/templates/promote',[
        'model' => $model,
        'sumopenjobs' => $sumopenjobs,
        'myhourlies' => $myhourlies,
        'items' => $result,
        'checked' => $result2,
        ]);
  }
}
