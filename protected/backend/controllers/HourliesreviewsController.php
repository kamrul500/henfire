<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Hourliesreviews;
use app\models\HourliesreviewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\MyHelpers;

/**
 * HourliesreviewsController implements the CRUD actions for Hourliesreviews model.
 */
class HourliesreviewsController extends Controller
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
     * Lists all Hourliesreviews models.
     * @return mixed
     */
    public function actionIndex()
    {
      if(!Yii::$app->user->identity->isAdmin)
  		{
  			Yii::$app->user->logout();
  			 return $this->goHome();
  		}
        $searchModel = new HourliesreviewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $allHourliereviews = Hourliesreviews::find()->all();
        foreach($allHourliereviews as $key)
        {
          $id = $key['id'];
          $hourlieid = $key['hourlie_id'];
          $jobid = $key['job_id'];
          $userid = $key['user_id'];
          $freelancerid = $key['freelancer_id'];
          $rating = $key['rating'];
          $review = $key['review'];
          $date = $key['date'];
          $reply = $key['replies'];
          $string = preg_replace("/[^\w]+/", '-', MyHelpers::HourlieIdtoName($hourlieid));
          $SeoURL = strtolower($string);
          $delete = Html::a('', 'hourliesreviews/delete?id='.$id,
            [
             'data' => [
                     'method' => 'post',
                       // use it if you want to confirm the action
                     'confirm' => 'Are you sure?',
                     ],
            'class' => 'glyphicon glyphicon-trash btn btn-default btn-xs custom_button'
            ]
          );
          $table .= '
          <tr>
            <td>'.Html::a(MyHelpers::HourlieIdtoName($hourlieid),Url::base(true).'/hourlies/'.$SeoURL.'-'.$hourlieid,['target'=>'_blank']).'</td>
            <td>'.$review.'</td>
            <td>'.$reply.'</td>
            <td>'.$rating.'</td>
            <td>'.$userid.'</td>
            <td>'.$freelancerid.'</td>
            <td>'.$date.'</td>
            <td>
            <a href="hourliesreviews/view?id='.$id.'">
              <i class="fa fa-eye" aria-hidden="true"></i>
            </a>
                <a href="hourliesreviews/update?id='.$id.'">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
                '.$delete.'
          </tr>
          ';
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'table' => $table,
        ]);
    }

    /**
     * Displays a single Hourliesreviews model.
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
     * Creates a new Hourliesreviews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Hourliesreviews();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Hourliesreviews model.
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
     * Deletes an existing Hourliesreviews model.
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
     * Finds the Hourliesreviews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Hourliesreviews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hourliesreviews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
