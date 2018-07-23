<?php

namespace frontend\controllers;

use Yii;
use app\models\HourliesReviews;
use frontend\models\HourliesReviewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HourliesReviewsController implements the CRUD actions for HourliesReviews model.
 */
class HourliesReviewsController extends Controller
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
     * Lists all HourliesReviews models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HourliesReviewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('@app/views/templates/hourliesreviews', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HourliesReviews model.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('@app/views/templates/hourliesreviewsview', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HourliesReviews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HourliesReviews();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/dashboard']);
        } else {
            return $this->render('@app/views/templates/hourliesreviewscreate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing HourliesReviews model.
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
            return $this->redirect(['hourliesreviewsview', 'id' => $model->id]);
        } else {
            return $this->render('@app/views/templates/hourliesreviewsupdate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing HourliesReviews model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['hourliesreviews']);
    }

    /**
     * Finds the HourliesReviews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return HourliesReviews the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HourliesReviews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
