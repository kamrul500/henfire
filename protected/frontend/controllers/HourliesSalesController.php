<?php

namespace frontend\controllers;

use Yii;
use app\models\HourliesSales;
use app\models\HourliesSalesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HourliesSalesController implements the CRUD actions for HourliesSales model.
 */
class HourliesSalesController extends Controller
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
     * Lists all HourliesSales models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HourliesSalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('@app/views/templates/hourliessales', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HourliesSales model.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('@app/views/templates/hourliessalesview', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HourliesSales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HourliesSales();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['hourliessalesview', 'id' => $model->id]);
        } else {
            return $this->render('@app/views/templates/hourliessalescreate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing HourliesSales model.
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
            return $this->redirect(['hourliessalesview', 'id' => $model->id]);
        } else {
            return $this->render('@app/views/templates/hourliessalesupdate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing HourliesSales model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['hourliessales']);
    }

    /**
     * Finds the HourliesSales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return HourliesSales the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HourliesSales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
