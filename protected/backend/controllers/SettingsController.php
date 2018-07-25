<?php

namespace backend\controllers;

use Yii;
use app\models\Settings;
use app\models\UserSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use kartik\widgets\Select2;
use app\models\AppsCountries;
use yii\helpers\ArrayHelper;

/**
 * SettingsController implements the CRUD actions for Settings model.
 */
class SettingsController extends Controller
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
     * Lists all Settings models.
     * @return mixed
     */
    public function actionIndex()
    {
      if(!Yii::$app->user->identity->isAdmin)
  		{
  			Yii::$app->user->logout();
  			 return $this->goHome();
  		}
      $model = $this->findModel('1');
      if ($model->logonew = UploadedFile::getInstance($model, 'logonew')) {
          $randname2 = Yii::$app->security->generateRandomString();

          $model->logonew->saveAs( Yii::getAlias('@uploads').'/' . $randname2.'.'.$model->logonew->extension);

          $model->logo = Url::base().'/uploads/' .$randname2.'.'.$model->logonew->extension;
      }


      if ($model->load(Yii::$app->request->post()) && $model->save()) {
		  $request = Yii::$app->request;

		  $name = $request->post('Countries');
		  Yii::$app->db->createCommand('UPDATE {{%apps_countries}} SET 	display=0 WHERE display=1')->execute();

		  if(!empty($name))
		  {
			  if(is_array($name))
			  {
				foreach($name as $val)
					{
						Yii::$app->db->createCommand('UPDATE {{%apps_countries}} SET 	display=1 WHERE id='.$val)->execute();
					}
			  }
			  else
			  {
				  Yii::$app->db->createCommand('UPDATE {{%apps_countries}} SET 	display=1 WHERE id='.$name)->execute();
			  }
		  }

        return $this->render('update', [
            'model' => $model,
        ]);
      } else {

          return $this->render('update', [
              'model' => $model,
          ]);
      }
    }


    /**
     * Updates an existing Settings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionAnalytics()
    {
        $model = $this->findModel('1');
      if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->render('/analytics/index', [
            'model' => $model,
        ]);
      }
      return $this->render('/analytics/index', [
          'model' => $model,
      ]);
    }
    public function actionUpdate()
    {
      $model = $this->findModel('1');
	  $model2 = new AppsCountries();

      if ($model->logo = UploadedFile::getInstance($model, 'logo')) {
          $randname2 = Yii::$app->security->generateRandomString();
          $model->logo->saveAs(Yii::getAlias('@uploads').'/' .$randname2.'.'.$model->imageFile->extension);

          $model->logo = Url::base().'/uploads/'.$randname2.'.'.$model->logo->extension;
      }


      if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->render('update', [
            'model' => $model,
			'model2' => $model2,
        ]);
      } else {
          return $this->render('update', [
              'model' => $model,
			  'model2' => $model2,
          ]);
      }
    }

    /**
     * Deletes an existing Settings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    /**
     * Finds the Settings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Settings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Settings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
