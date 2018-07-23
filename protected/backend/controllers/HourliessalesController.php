<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Hourliessales;
use app\models\HourliessalesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Hourlies;
use app\models\Job;
use app\models\User;
use common\components\MyHelpers;
use Symfony\Component\Intl\Intl;

/**
 * HourliessalesController implements the CRUD actions for hourliessales model.
 */
class HourliessalesController extends Controller
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
     * Lists all hourliessales models.
     * @return mixed
     */
    public function actionIndex()
    {
      if(!Yii::$app->user->identity->isAdmin)
  		{
  			Yii::$app->user->logout();
  			 return $this->goHome();
  		}

      $hourlies = hourliessales::find()->orderBy(['date_bought'=>SORT_DESC])->all();
      $curencySymbol = Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency());
      $currencycodelow = strtolower(MyHelpers::Currency());
      foreach ($hourlies as $sales)
      {
        $id = $sales['id'];
        $orderid = $sales['custom_trans_id'];
        $itemid = $sales['item_id'];
        $name = $sales['item_name'];
        $price = $sales['total_cost'];
        $completeStatus = $sales['completed'];
        $paidstatus = $sales['paid_status'];
        $buyer = MyHelpers::IdToName($sales['buyer_id']);
        $seller = MyHelpers::IdToName($sales['seller_id']);

        if($completeStatus == 1)
        {
          $statuslabel = 'label-success';
          $status = Yii::t('backend', 'Completed');
        }
        else {
          $statuslabel = 'label-warning';
          $status = Yii::t('backend', 'In Progress');
        }
        $label = 'label-success';
        $workflow = '<a href="hourlieworkstream/view?id='.$id.'">
          <i class="fa fa-pencil" aria-hidden="true"></i>
        </a>';
        if($paidstatus == 'Pending')
        {
          $label = 'label-danger';
          $workflow = '<span class="label label-danger">'.Yii::t('backend', 'Pending Payment').'</span>';
        }
        $string = preg_replace("/[^\w]+/", '-', $name);
        $SeoURL = strtolower($string);
        $latesthourliesales .= '
        <tr>
          <td>'.$orderid.'</td>
          <td>'.Html::a($name,Url::base(true).'/hourlies/'.$SeoURL.'-'.$itemid,['target'=>'_blank']).'</td>
          <td><span class="label '.$label.'">'.$paidstatus.'</span></td>
          <td><span class="label '.$statuslabel.'">'.$status.'</span></td>
          <td>'.$curencySymbol . $price.'</td>
          <td>
            <div class="sparkbar" data-color="#00a65a" data-height="20">'.$buyer.'</div>
          </td>
          <td>'.$workflow.'</td>
        </tr>
        ';
      }

        	return $this->render('index', [
              'latesthourliesales' => $latesthourliesales,
              'curencySymbol' => $curencySymbol,
              'currencycodelow' => $currencycodelow,
          ]);
    }

    /**
     * Displays a single hourliessales model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new hourliessales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new hourliessales();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing hourliessales model.
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
     * Deletes an existing hourliessales model.
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
     * Finds the hourliessales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return hourliessales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = hourliessales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
