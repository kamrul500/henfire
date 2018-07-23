<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use app\models\FreelanceJobs;
use app\models\FreelanceJobsSearch;
use app\models\JobCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FreelanceJobsController implements the CRUD actions for FreelanceJobs model.
 */
class FreelanceJobsController extends Controller
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
     * Lists all FreelanceJobs models.
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
        $searchModel = new FreelanceJobsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //display the Category list//
        $categories = JobCategory::find()->groupBy(['Category'])->all();

        $cList = '';
        foreach ($categories as $cat)
        {

          $cList.= '<li>'.Html::checkBox('category[]', false, ['label' => $cat['Category'], 'value' => $cat['Category'], 'class' => 'catclass']).'</li>';
        }

        return $this->render('@app/views/templates/freelancerjobs', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => $cList,
        ]);
    }

    /**
     * Displays a single FreelanceJobs model.
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
        return $this->render('@app/views/templates/freelancerjobsview', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FreelanceJobs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(Yii::$app->urlManager->createUrl('user/register'));

            return true;
        }
        $model = new FreelanceJobs();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['freelancerjobsview', 'id' => $model->id]);
        } else {
            return $this->render('@app/views/templates/freelancerjobscreate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FreelanceJobs model.
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
            return $this->redirect(['freelancerjobsview', 'id' => $model->id]);
        } else {
            return $this->render('@app/views/templates/freelancerjobsupdate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FreelanceJobs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['freelancerjobs']);
    }

    /**
     * Finds the FreelanceJobs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return FreelanceJobs the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FreelanceJobs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
