<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use app\models\Freelancer;
use app\models\FreelancerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AppsCountries;

/**
 * FreelancerController implements the CRUD actions for Freelancer model.
 */
class FreelancerController extends Controller
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
     * Lists all Freelancer models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
      $current_user=Yii::$app->user->identity->id;
      $session = Yii::$app->session;
      $session['userView'] = [
              'user' => $current_user,
              'returnURL' => Yii::$app->request->url,
              ];
        $searchModel = new FreelancerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //display the county list//
        $countries = AppsCountries::find()->where(['display'=>'1'])
                   ->all();

        $cList = '';
        foreach ($countries as $country)
        {

          $cList.= '<li>'.Html::checkBox('country[]', false, ['label' => Yii::t('frontend', $country['country_name']), 'value' => $country['country_code'], 'class' => 'countrylink']).'</li>';
        }

        return $this->render('@app/views/templates/freelancer', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'CountryList' => $cList,
        ]);
    }

    /**
     * Displays a single Freelancer model.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
      $current_user=Yii::$app->user->identity->id;
      $session = Yii::$app->session;
      $session['userView'] = [
              'user' => $current_user,
              'returnURL' => Yii::$app->request->url,
              ];
        return $this->render('@app/views/templates/freelancerview', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Freelancer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Freelancer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['freelancerview', 'id' => $model->id]);
        } else {
            return $this->render('@app/views/templates/freelancercreate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Freelancer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['freelancerview', 'id' => $model->id]);
        } else {
            return $this->render('@app/views/templates/freelancerupdate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Freelancer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['freelancer']);
    }

    /**
     * Finds the Freelancer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return Freelancer the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Freelancer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
