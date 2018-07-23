<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Hourlies;
use app\models\HourliesSearch;
use app\models\Job;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Symfony\Component\Intl\Intl;
use yii\web\UploadedFile;
use yii\helpers\Json;
use common\components\MyHelpers;

/**
 * HourliesController implements the CRUD actions for Hourlies model.
 */
class HourliesController extends Controller
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
     * Lists all Hourlies models.
     * @return mixed
     */
    public function actionIndex()
    {
      if(!Yii::$app->user->identity->isAdmin)
  		{
  			Yii::$app->user->logout();
  			 return $this->goHome();
  		}
        $searchModel = new HourliesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $curencySymbol = Intl::getCurrencyBundle()->getCurrencySymbol(MyHelpers::Currency());

        $allhourlies = Hourlies::find()->all();

        foreach($allhourlies as $hourlie)
        {
          $id = $hourlie['id'];
          $category = $hourlie['category'];
          $title = $hourlie['title'];
          $userid = $hourlie['user_id'];
          $price = $hourlie['cost'];
          $date = $hourlie['date_created'];
          $promoted = $hourlie['promoted'];
          $dissabled = $hourlie['dissabled'];
          $activestate = '';
          $string = preg_replace("/[^\w]+/", '-', $title);
          $SeoURL = strtolower($string);
          if($dissabled == 1)
          {
            $activestate = '<small class="label bg-black-active color-palette">Dissabled</small>';
          }
          $promotedstate ='';
          if($promoted == 1)
          {
            $promotedstate = '<small class="label bg-green">Prmoted</small>';
          }

          $string = preg_replace("/[^\w]+/", '-', $title);
          $SeoURL = strtolower($string);
          $delete = Html::a('', 'hourlies/delete?id='.$id,
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
            <td>'.Html::a($title,Url::base(true).'/hourlies/'.$SeoURL.'-'.$id,['target'=>'_blank']).'</td>
            <td>'.MyHelpers::IdToName($userid).'</td>
            <td>'.$curencySymbol . $price.'</td>
            <td>'.$date.'</td>
            <td>'.$category.'</td>
            <td>'.$promotedstate.' '.$activestate.'</td>
            <td>
            <a href="'.Url::base(true).'/hourlies/'.$SeoURL.'-'.$id.'" target="_blank">
              <i class="fa fa-eye" aria-hidden="true"></i>
            </a>
                <a href="hourlies/update?id='.$id.'">
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
     * Displays a single Hourlies model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      $model = $this->findModel($id);

        $test = 'BOB';
        return $this->render('view', [
            'model' => $model,

        ]);
    }

    /**
     * Creates a new Hourlies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Hourlies();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          $model->images = UploadedFile::getInstances($model, 'image');

          if(!empty($model->images))
          {
          $array = array();
          foreach ($model->images as $key => $file) {
              $random = Yii::$app->security->generateRandomString();
              $file->saveAs('uploads/'.$random.'.'.$file->extension); //Upload files to server
                  $array[] .= Url::home(true).'uploads/'.$random.'.'.$file->extension; //Save file names in database- '**' is for separating images
           }
           $model->images = Json::encode(array_values($array));
          }
          return $this->redirect(['/hourlies']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Hourlies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
      $model = $this->findModel($id);



        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          $model->images = UploadedFile::getInstances($model, 'image');

          if(!empty($model->images))
          {
          $array = array();
          foreach ($model->images as $key => $file) {
              $random = Yii::$app->security->generateRandomString();
              $file->saveAs('uploads/'.$random.'.'.$file->extension); //Upload files to server
                  $array[] .= Url::home(true).'uploads/'.$random.'.'.$file->extension; //Save file names in database- '**' is for separating images
           }
           $model->images = Json::encode(array_values($array));
          }
            return $this->redirect(['/hourlies']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'thumbnail' => $thumbnail,
            ]);
        }
    }

    /**
     * Deletes an existing Hourlies model.
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
     * Finds the Hourlies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Hourlies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hourlies::findOne($id)) !== null) {
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
