<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use app\models\Invite;
use app\models\InviteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\MyHelpers;

/**
 * InviteController implements the CRUD actions for Invite model.
 */
class InviteController extends Controller
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
     * Lists all Invite models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InviteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Invite model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionMember($id)
    {
      $model = new Invite();
      $freelancer = $id;
      $user = Yii::$app->user->identity->id;

      if ($model->load(Yii::$app->request->post()) && $model->save()) {

        Yii::$app->mailer->compose()
          ->setTo(MyHelpers::IdToEmail($model->frelancer))
          ->setFrom([MyHelpers::WebsiteEmail() => MyHelpers::WebsiteName()])
          ->setSubject(Yii::t('frontend','User Invite to Job'))
          ->setTextBody(Yii::t('frontend','You have been invited to a job'))
          ->setHtmlBody('<b>'.Yii::t('frontend', 'Dear').' '.MyHelpers::IdToFullName($model->frelancer).'</b>
          <br />
          '.Yii::t('frontend', 'You have been invited to offer a proposal for a job.').'
          <br />
          '.Yii::t('frontend', 'Please follow this link to participate.').'
          <br />
          '.Url::home(true).'job/work-needs-to-be-done-more-35
          <br / />
          <b>'.Yii::t('frontend', 'Message:').'</b> '.$model->message.'
          ')
          ->send();

          return $this->redirect(['./freelancer']);
      } else {
          return $this->render('create', [
              'model' => $model,
              'freelancer' => $freelancer,
              'user' => $user
          ]);
      }
    }

    /**
     * Creates a new Invite model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Invite();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Invite model.
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
     * Deletes an existing Invite model.
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
     * Finds the Invite model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Invite the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invite::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
