<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\JobCategory;
use app\models\JobCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JobCategoryController implements the CRUD actions for JobCategory model.
 */
class JobCategoryController extends Controller
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
     * Lists all JobCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
      if(!Yii::$app->user->identity->isAdmin)
  		{
  			Yii::$app->user->logout();
  			 return $this->goHome();
  		}
        $searchModel = new JobCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $allcategories = JobCategory::find()->all();
        foreach($allcategories as $cat)
        {
          $id = $cat['id'];
          $category = $cat['Category'];
          $subcategory = $cat['SubCategory'];
          $delete = Html::a('', 'job-category/delete?id='.$id,
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
            <td>'.$category.'</td>
            <td>'.$subcategory.'</td>
            <td>
                <a href="job-category/update?id='.$id.'">
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
     * Displays a single JobCategory model.
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
     * Creates a new JobCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new JobCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/job-category']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing JobCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/job-category']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing JobCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/job-category']);
    }

    /**
     * Finds the JobCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JobCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JobCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
