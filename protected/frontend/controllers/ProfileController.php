<?php

namespace frontend\controllers;

use Yii;
use app\models\User;
use app\models\AppsCountries;
use yii\helpers\Url;
use app\models\UserSearch;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\Html;
use common\components\MyHelpers;
use nirvana\prettyphoto\PrettyPhoto;
use kartik\widgets\StarRating;
//use imanilchaudhari\CurrencyConverter\CurrencyConverter;
use yii\authclient\widgets\AuthChoice;


class ProfileController extends \yii\web\Controller
{
    public function actionIndex()
    {
      $current_user=Yii::$app->user->identity->id;
      $session = Yii::$app->session;
      $session['userView'] = [
              'user' => $current_user,
              'returnURL' => Yii::$app->request->url,
              ];
        if (Yii::$app->user->isGuest) {
            $this->redirect(Yii::$app->urlManager->createUrl('user/login'));

            return true;
        }

        $id = Yii::$app->user->identity->id;
          $model = $this->findModel($id);
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        /* @var $this yii\web\View */
        /* @var $model app\models\User */
        $mycurrency = MyHelpers::Currency();
        //if (Yii::$app->user->isGuest) {
            //$mycurrency = MyHelpers::Currency();
        //} else {
          //  $mycurrency = Yii::$app->user->identity->currency;
        //}
        //$theircurrency = $model->currency;

        //$converter = new CurrencyConverter();
        //$rate = $converter->convert($theircurrency, $mycurrency);

        $price = $model->hourlie_rate;

        $cover_photo = $model->cover_photo;
        if (!empty($cover_photo)) {
            $style = 'style="background-image:url('.$cover_photo.');
            background-size: contain;
            -webkit-background-size: 100% 100%;
            -moz-background-size: 100% 100%;
            -o-background-size: 100% 100%;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            "';
            $add_cover = '';
            $luminance = MyHelpers::get_avg_luminance(Url::home(true).$cover_photo, 10);
            if ($luminance > 170) {
                $textcolour = '';
            } else {
                $textcolour = 'text-light';
            }
            $profile_top = 'big_profile_top';
        } else {
                $style = '';
                $add_cover = Html::a('<span class="fa fa-fw fa-camera"></span>Add cover photo', ['update'], ['class' => 'btn btn-default']);
                $textcolour = '';
                $profile_top = 'profile_top';
            }
        if ($model->available_now > 0) {
            $available_now = '<span class="fa fa-fw fa-check-circle green"></span> Available now';
        } else {
                $available_now = '<span class="fa fa-fw fa-times-circle red"></span> Not available';
            }
            if(MyHelpers::IsFreelancer($id) == 1)
            {
              return $this->render('@app/views/templates/profile', [
                  'model' => $this->findModel($id),
                  'style' => $style,
                  'profile_top' => $profile_top,
                  'textcolour' => $textcolour,
                  'add_cover' => $add_cover,
                  'add_cover' => $add_cover,
                  'available_now' => $available_now,
                  'mycurrency' => $mycurrency,
                  'price' => $price,
              ]);
            }
            else {

                return $this->render('@app/views/templates/profile_member', [
                    'model' => $this->findModel($id),
                    'style' => $style,
                    'profile_top' => $profile_top,
                    'textcolour' => $textcolour,
                    'add_cover' => $add_cover,
                    'add_cover' => $add_cover,
                    'available_now' => $available_now,
                    'mycurrency' => $mycurrency,
                    'price' => $price,
                ]);
              }

    }

    public function actionView($id)
    {
      //if (Yii::$app->user->isGuest) {
      $mycurrency = MyHelpers::Currency();
      //} else {
        //  $mycurrency = Yii::$app->user->identity->currency;
      //}

      $model = $this->findModel($id);
      //$theircurrency = $model->currency;
      //$converter = new CurrencyConverter();
      //$rate = $converter->convert($theircurrency, $mycurrency);
      $price = $model->hourlie_rate;
      $contact = Html::a(Yii::t('frontend', 'Invite'), ['invite'], ['class' => 'btn btn-warning']);

      $starratings = StarRating::widget(['name' => 'rating', 'value' => $model->rating,
          'pluginOptions' => [
              'displayOnly' => true,
              'stars' => 5,
              'min' => 0,
              'max' => 5,
              'step' => 0.1,

          ],
      ]);
      $onlinenow = MyHelpers::isonline($model->id);
      $cover_photo = Url::home(true).$model->cover_photo;
      if (!empty($cover_photo)) {
          $style = 'style="background-image:url('.$cover_photo.'); background-size: cover;"';
          $add_cover = '';
          $luminance = MyHelpers::get_avg_luminance($cover_photo, 10);
          if ($luminance > 170) {
              $textcolour = '';
          } else {
              $textcolour = 'text-light';
          }
          $profile_top = 'big_profile_top';
      } else {
              $style = '';
              $add_cover = '';
              $textcolour = '';
              $profile_top = 'profile_top';
          }
      if ($model->available_now > 0) {
          $available_now = '<span class="fa fa-fw fa-check-circle green"></span> Available now';
      } else {
              $available_now = '<span class="fa fa-fw fa-times-circle red"></span> Not available';
          }
          $introduction = $model->introduction;
          if (strlen($introduction) > 147) {
              $introduction = substr($introduction, 0, 147).' <a href="#" data-toggle="modal" data-target="#myModal" class="green">more...</a>';
          }
          if (MyHelpers::verifiedfacebook($model->id) == 'connect') {
            $facebook = '<span class="fa fa-fw fa-times-circle red"></span> verified';

          } else {
              $facebook = MyHelpers::verifiedfacebook($model->id);
                }
          if (MyHelpers::verifiedlinkedin($model->id) == 'connect') {
            $linkedin = '<span class="fa fa-fw fa-times-circle red"></span> verified';
          } else {
            $linkedin = MyHelpers::verifiedlinkedin($model->id);
          }
          $projectescompleted = MyHelpers::projectscompleted($model->id);
          $hourliessales = MyHelpers::hourliessales($model->id);
          $lastproject = MyHelpers::lastproject($model->id);
          $myportfolio = MyHelpers::myPortFolioPublic($model->portfolio);
          $widgets = PrettyPhoto::widget();
          $myhourlies = MyHelpers::MyHourliesPublic($model->id);
          $skills = $model->skills;
          $splitted = explode(',', $skills);
          $skills = json_decode(json_encode($splitted), true);
          $skillset='';
               foreach ($skills as $value) {
                   $skillset .= '<li><a href="../freelancer?FreelancerSearch[skills]='.$value.'" class="tag">'.$value.'</a></li>';
               }
        return $this->render('@app/views/templates/profileview', [
            'model' => $this->findModel($id),
            'style' => $style,'profile_top' => $profile_top,
            'textcolour' => $textcolour,'add_cover' => $add_cover,
            'introduction' => $introduction,'available_now' => $available_now,
            'starratings' => $starratings,'contact' => $contact,
            'mycurrency' => $mycurrency,'price' => $price,
            'onlinenow' => $onlinenow,'facebook' => $facebook,
            'linkedin' => $linkedin,'projectescompleted' => $projectescompleted,
            'hourliessales' => $hourliessales, 'lastproject' => $lastproject,
            'myportfolio' => $myportfolio, 'widgets' => $widgets,
            'myhourlies' => $myhourlies, 'skills' => $skillset,

        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['profileview', 'id' => $model->id]);
        } else {
            return $this->render('@app/views/templates/profilecreate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdate()
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(Yii::$app->urlManager->createUrl('user/login'));

            return true;
        }
        $id = Yii::$app->user->identity->id;
        $model = $this->findModel($id);
        //save the profile picture
        if ($model->file = UploadedFile::getInstance($model, 'file')) {
            $randname1 = Yii::$app->security->generateRandomString();
            $model->file->saveAs(Yii::getAlias('@uploads').'/' .$randname1.'.'.$model->file->extension);

            $model->profile_picture = Url::base().'/uploads/'.$randname1.'.'.$model->file->extension;
        }
        //save the cover photo
        if ($model->imageFile = UploadedFile::getInstance($model, 'imageFile')) {
            $randname2 = Yii::$app->security->generateRandomString();
            $model->imageFile->saveAs(Yii::getAlias('@uploads').'/' .$randname2.'.'.$model->imageFile->extension);

            $model->cover_photo = 'uploads/'.$randname2.'.'.$model->imageFile->extension;
        }
        //save the portfolio
        if ($model->uploadPortfolio = UploadedFile::getInstances($model, 'uploadPortfolio')) {
            $array = '';
            foreach ($model->uploadPortfolio as $images) {
                $randname3 = Yii::$app->security->generateRandomString();
                $images->saveAs(Yii::getAlias('@uploads').'/' .$randname3.'.'.$images->extension);
                $array[] .= Url::base().'/uploads/'.$randname3.'.'.$images->extension;
            }
            //$splitted = explode(",", $array);
            //$portfolio = json_decode(json_encode($splitted), true);
            $model->portfolio = Json::encode(array_values($array));
        }
        //get Country country_code
        $countryset = AppsCountries::find()->where(['country_name'=> $model->country])->one();

        $model->country_code = $countryset['country_code'];
        //finish the save and redirect back to profile

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['./profile']);
        } else {
          if(MyHelpers::IsFreelancer($id) == 1)
          {
            return $this->render('@app/views/templates/profileupdate', [
                'model' => $model,
            ]);
          }
          else {
            {
              return $this->render('@app/views/templates/profileupdatemember', [
                'model' => $model,
              ]);
            }
          }
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return User the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        //$id = '1';
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
