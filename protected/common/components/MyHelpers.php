<?php
namespace common\components;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use app\models\Hourlies;
use app\models\Hourliessales;
use app\models\Job;
use app\models\User;
use app\models\JobSearch;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class MyHelpers
{
    public static function WebsiteName() {

		$name = Yii::$app->db->createCommand('SELECT sitename FROM {{%settings}}');
            $reader = $name->query();
			$dataUser = $reader->readAll();

        return $dataUser['0']['sitename'];
    }
    public static function Websitetagline() {

		$name = Yii::$app->db->createCommand('SELECT site_seo_title FROM {{%settings}}');
            $reader = $name->query();
			$dataUser = $reader->readAll();

        return $dataUser['0']['site_seo_title'];
    }
	public static function WebsiteKeywords() {

		$name = Yii::$app->db->createCommand('SELECT keywords FROM {{%settings}}');
            $reader = $name->query();
			$dataUser = $reader->readAll();

        return $dataUser['0']['keywords'];
    }
    public static function WebsiteEmail() {

		$name = Yii::$app->db->createCommand('SELECT email FROM {{%settings}}');
            $reader = $name->query();
			$dataUser = $reader->readAll();

        return $dataUser['0']['email'];
    }
	 public static function WebsiteLogo() {

		$name = Yii::$app->db->createCommand('SELECT logo FROM {{%settings}}');
            $reader = $name->query();
			$dataUser = $reader->readAll();

        return $dataUser['0']['logo'];
    }
    public static function categories()
    {
      $name = Yii::$app->db->createCommand('SELECT * FROM {{%job_category}} GROUP BY Category');
      $reader = $name->query();
   		$dataUser = $reader->readAll();

      foreach($dataUser as $keyval)
      {
        $catlist .= '
          <div class="col-md-3 col-sm-3 col-xs-3">
          <a href="hourlies/?HourliesSearch%5Bcategory%5D='.urlencode($keyval['Category']).'" id="cat-link">
            <i id="cat-gly" class="cat-gly glyphicon '.$keyval['glyphicon'].'"></i>
            <h4 class="cat-title">
            '.$keyval['Category'].'
            </h4>
            <p id="hidden-text">
              '.$keyval['description'].'
            </p>
            </a>
          </div>
        ';
      }
      return $catlist;
    }
    public static function categori_menu()
    {
      $name = Yii::$app->db->createCommand('SELECT *, GROUP_CONCAT(SubCategory) FROM {{%job_category}} GROUP BY Category');
      $reader = $name->query();
   		$dataUser = $reader->readAll();
      foreach($dataUser as $keyval)
      {
        $catlist .= '
        <li class="dropdown">
      <a class="dropdown-toggle disabled" data-toggle="dropdown" href="'.Url::base().'/hourlies/?HourliesSearch%5Bcategory%5D='.$keyval['Category'].'">'.$keyval['Category'].'
      <span class="caret"></span></a>
      <ul class="dropdown-menu row">
      <li class="col-sm-9">
        '.MyHelpers::categori_menu_set($keyval['Category']).'
      </ul>
    </li>
        ';
      }
      return $catlist;
    }
    public static function categori_menu_set($catname)
    {
      $name = Yii::$app->db->createCommand('SELECT * FROM {{%job_category}} WHERE Category = "'.$catname.'"');
      $reader = $name->query();
   		$dataUser = $reader->readAll();
      $i = 0;
      foreach($dataUser as $keyval)
      {
        $i ++;
        $catlist .= '<li><a href="'.Url::base().'/hourlies/?HourliesSearch%5Bcategory%5D='.$catname.'&HourliesSearch%5BsubCat%5D='.$keyval['SubCategory'].'">'.$keyval['SubCategory'].'</a></li>';
      }

      return $catlist;
    }
    public static function categori_menu_view()
    {
      $name = Yii::$app->db->createCommand('SELECT *, GROUP_CONCAT(SubCategory) FROM {{%job_category}} GROUP BY Category');
      $reader = $name->query();
   		$dataUser = $reader->readAll();
      foreach($dataUser as $keyval)
      {
        $catlist .= '
        <li class="dropdown">
      <a class="dropdown-toggle disabled" data-toggle="dropdown" href="'.Url::base().'/hourlies/?HourliesSearch%5Bcategory%5D='.$keyval['Category'].'">'.$keyval['Category'].'
      <span class="caret"></span></a>
      <ul class="dropdown-menu row">
      <li class="col-sm-9">
        '.MyHelpers::categori_menu_view_set($keyval['Category']).'
      </ul>
    </li>
        ';
      }
      return $catlist;
    }
    public static function categori_menu_view_set($catname)
    {
      $name = Yii::$app->db->createCommand('SELECT * FROM {{%job_category}} WHERE Category = "'.$catname.'"');
      $reader = $name->query();
   		$dataUser = $reader->readAll();
      $i = 0;
      foreach($dataUser as $keyval)
      {
        $i ++;
        $catlist .= '<li><a href="'.Url::base().'/hourlies/?HourliesSearch%5Bcategory%5D='.$catname.'&HourliesSearch%5BsubCat%5D='.$keyval['SubCategory'].'">'.$keyval['SubCategory'].'</a></li>';
      }

      return $catlist;
    }
    public static function categori_menu_jobs()
    {
      $name = Yii::$app->db->createCommand('SELECT *, GROUP_CONCAT(SubCategory) FROM {{%job_category}} GROUP BY Category');
      $reader = $name->query();
   		$dataUser = $reader->readAll();
      foreach($dataUser as $keyval)
      {
        $catlist .= '
        <li class="dropdown">
      <a class="dropdown-toggle disabled" data-toggle="dropdown" href="'.Url::base().'/freelance-jobs/?FreelanceJobsSearch[category]='.$keyval['Category'].'">'.$keyval['Category'].'
      <span class="caret"></span></a>
      <ul class="dropdown-menu row">
      <li class="col-sm-9">
        '.MyHelpers::categori_menu_jobs_set($keyval['Category']).'
      </ul>
    </li>
        ';
      }
      return $catlist;
    }
    public static function categori_menu_jobs_set($catname)
    {
      $name = Yii::$app->db->createCommand('SELECT * FROM {{%job_category}} WHERE Category = "'.$catname.'"');
      $reader = $name->query();
   		$dataUser = $reader->readAll();
      $i = 0;
      foreach($dataUser as $keyval)
      {
        $i ++;
        $catlist .= '<li><a href="'.Url::base().'/freelance-jobs/?FreelanceJobsSearch[category]='.$catname.'&FreelanceJobsSearch[subCat]='.$keyval['SubCategory'].'">'.$keyval['SubCategory'].'</a></li>';
      }

      return $catlist;
    }
    public static function categorie_pitures()
    {
      $name = Yii::$app->db->createCommand('SELECT * FROM {{%job_category}} GROUP BY Category');
      $reader = $name->query();
   		$dataUser = $reader->readAll();

      foreach($dataUser as $keyval)
      {
        $catlist .= '
          <div class="col-md-4 col-sm-4">
            <a href="hourlies/?HourliesSearch%5Bcategory%5D='.urlencode($keyval['Category']).'" id="cat-link">
            '.Html::a(Html::img('/uploads/airline.jpg'),['hourlies/?HourliesSearch%5Bcategory%5D='.urlencode($keyval['Category'])]).'
            </a>
          </div>
        ';
      }
      return $catlist;
    }
    public static function Analytics() {

 		$name = Yii::$app->db->createCommand('SELECT analytics FROM {{%settings}}');
             $reader = $name->query();
 			$dataUser = $reader->readAll();

         return $dataUser['0']['analytics'];
     }
    public static function FeatureHourliePrice() {

		$name = Yii::$app->db->createCommand('SELECT feature_hourlie_price FROM {{%settings}}');
            $reader = $name->query();
			$dataUser = $reader->readAll();

        return $dataUser['0']['feature_hourlie_price'];
    }
    public static function FeatureJobPrice() {

		$name = Yii::$app->db->createCommand('SELECT feature_job_price FROM {{%settings}}');
            $reader = $name->query();
			$dataUser = $reader->readAll();

        return $dataUser['0']['feature_job_price'];
    }
    /*Get the currency from Yahoo, but lets add this to the database also and check the date and time so that we will update it every 6 hours*/
  public static function CurrencyExchange($theircurrency, $mycurrency) {
    $url = file_get_contents('https://query.yahooapis.com/v1/public/yql?q=select+*+from+yahoo.finance.xchange+where+pair+=+"'.$theircurrency.''.$mycurrency.'"&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys');
    $results = json_decode($url, true);
    $ratedata = $results['query']['results']['rate'];
    return $ratedata['Rate'];
  }
  public static function Commission() {

 		$name = Yii::$app->db->createCommand('SELECT commission FROM {{%settings}}');
             $reader = $name->query();
 			$dataUser = $reader->readAll();

         return $dataUser['0']['commission'];
     }
	public static function Twitter() {

		$name = Yii::$app->db->createCommand('SELECT twitter FROM {{%settings}}');
            $reader = $name->query();
			$dataUser = $reader->readAll();

        return $dataUser['0']['twitter'];
    }
	public static function Facebook() {

		$name = Yii::$app->db->createCommand('SELECT facebook FROM {{%settings}}');
            $reader = $name->query();
			$dataUser = $reader->readAll();

        return $dataUser['0']['facebook'];
    }
	public static function Google() {

		$name = Yii::$app->db->createCommand('SELECT google FROM {{%settings}}');
            $reader = $name->query();
			$dataUser = $reader->readAll();

        return $dataUser['0']['google'];
    }

	public static function Currency() {

			$name = Yii::$app->db->createCommand('SELECT currency FROM {{%settings}}');
            $reader = $name->query();
			$dataUser = $reader->readAll();

        	return $currencycode = $dataUser['0']['currency'];
    }

	public static function FacebookLogin() {

		$name = Yii::$app->db->createCommand('SELECT * FROM {{%social_login}} WHERE social = "facebook"');
            $reader = $name->query();
			$dataUser = $reader->readAll();

        	$isenabled = $dataUser['0']['enabled'];
			if($isenabled == 1)
			{
				return Yii::t('frontend', 'Enabled');
			}
			else
			{
				return Yii::t('frontend', 'Dissabled');
			}
    }
  public static function PayPalAuth() {

  		  $name = Yii::$app->db->createCommand('SELECT PayPalAuth FROM {{%settings}}');
        $reader = $name->query();
  			$dataUser = $reader->readAll();

          return $dataUser['0']['PayPalAuth'];
      }
  public static function PayPalSecret() {

      $name = Yii::$app->db->createCommand('SELECT PayPalSecret FROM {{%settings}}');
          $reader = $name->query();
          $dataUser = $reader->readAll();

          return $dataUser['0']['PayPalSecret'];
      }
  public static function PayPalEnvironment() {

        $name = Yii::$app->db->createCommand('SELECT PayPalEnvironment FROM {{%settings}}');
            $reader = $name->query();
            $dataUser = $reader->readAll();

            return $dataUser['0']['PayPalEnvironment'];
        }
	public static function get_avg_luminance($filename, $num_samples=10) {
        $img = imagecreatefromjpeg($filename);

        $width = imagesx($img);
        $height = imagesy($img);

        $x_step = intval($width/$num_samples);
        $y_step = intval($height/$num_samples);

        $total_lum = 0;

        $sample_no = 1;

        for ($x=0; $x<$width; $x+=$x_step) {
            for ($y=0; $y<$height; $y+=$y_step) {

                $rgb = imagecolorat($img, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                // choose a simple luminance formula from here
                // http://stackoverflow.com/questions/596216/formula-to-determine-brightness-of-rgb-color
                $lum = ($r+$r+$b+$g+$g+$g)/6;

                $total_lum += $lum;

                // debugging code
     //           echo "$sample_no - XY: $x,$y = $r, $g, $b = $lum<br />";
                $sample_no++;
            }
        }

        // work out the average
        $avg_lum  = $total_lum/$sample_no;

        return $avg_lum;
    }
    public static function IsFreelancer($userid) {
      $name = Yii::$app->db->createCommand("SELECT * FROM {{%user}} WHERE id = '$userid'");
      $reader = $name->query();
  			$dataUser = $reader->readAll();
        return $dataUser['0']['is_freelancer'];
    }

	    public static function IdtoPic($userid) {
      $name = Yii::$app->db->createCommand("SELECT * FROM {{%user}} WHERE id = '$userid'");
      $reader = $name->query();
  			$dataUser = $reader->readAll();
        return $dataUser['0']['profile_picture'];
    }

  public static function IdToName($userid) {
    $name = Yii::$app->db->createCommand("SELECT * FROM {{%user}} WHERE id = '$userid'");
    $reader = $name->query();
			$dataUser = $reader->readAll();
      return $dataUser['0']['username'];
  }
  public static function IdToEmail($userid) {
    $name = Yii::$app->db->createCommand("SELECT * FROM {{%user}} WHERE id = '$userid'");
    $reader = $name->query();
			$dataUser = $reader->readAll();
      return $dataUser['0']['email'];
  }
  public static function IdToFullName($userid) {
    $name = Yii::$app->db->createCommand("SELECT * FROM {{%user}} WHERE id = '$userid'");
    $reader = $name->query();
			$dataUser = $reader->readAll();
      return $dataUser['0']['full_name'];
  }
  public static function IdToCountry($userid) {
    $name = Yii::$app->db->createCommand("SELECT * FROM {{%user}} WHERE id = '$userid'");
    $reader = $name->query();
			$dataUser = $reader->readAll();
      return $dataUser['0']['country'];
  }
  public static function IdToPayPalEmail($userid) {
    $name = Yii::$app->db->createCommand("SELECT * FROM {{%user}} WHERE id = '$userid'");
    $reader = $name->query();
      $dataUser = $reader->readAll();
      return $dataUser['0']['paypal_email'];
  }
  public static function IdToOccupation($userid) {
    $name = Yii::$app->db->createCommand("SELECT * FROM {{%user}} WHERE id = '$userid'");
    $reader = $name->query();
			$dataUser = $reader->readAll();
      return $dataUser['0']['occupation'];
  }
  public static function NameToID($username) {
    $name = Yii::$app->db->createCommand("SELECT * FROM {{%user}} WHERE username = '$username'");
    $reader = $name->query();
			$dataUser = $reader->readAll();
      return $dataUser['0']['id'];
  }
	public static function isonline($userid) {

		$name = Yii::$app->db->createCommand("SELECT * FROM {{%session_frontend_user}} WHERE user_id = '$userid'");
            $reader = $name->query();
			$dataUser = $reader->readAll();
		if(!empty($dataUser))
		{
			try
			{
				$isset = $dataUser['0']['user_id'];
				if($isset == $userid)
				{
					return '<span class="fa fa-fw fa-check-circle green"></span>'.Yii::t('frontend', 'Online');
				}
				else
				{
					return '<span class="fa fa-fw fa-times-circle red"></span>'.Yii::t('frontend', 'Offline');
				}
			}
			catch(Exception $e)
			{
				return '<span class="fa fa-fw fa-times-circle red"></span>'.Yii::t('frontend', 'Offline');
			}
		}
		else
		{
			return '<span class="fa fa-fw fa-times-circle red"></span>'.Yii::t('frontend', 'Offline');
		}
    }

	public static function verifiedfacebook($userid) {

		$name = Yii::$app->db->createCommand("SELECT * FROM {{%user}} WHERE id = '$userid'");
            $reader = $name->query();
			$dataUser = $reader->readAll();

        $isset = $dataUser['0']['facebook'];
		if(!empty($isset))
		{
			return '<span class="fa fa-fw fa-check-circle green"></span>'.Yii::t('frontend', 'Verified');
		}
		else
		{
			return Yii::t('frontend', 'Connect');
		}
	}
	public static function verifiedlinkedin($userid) {

		$name = Yii::$app->db->createCommand("SELECT * FROM {{%user}} WHERE id = '$userid'");
            $reader = $name->query();
			$dataUser = $reader->readAll();

        $isset = $dataUser['0']['linkedin'];
		if(!empty($isset))
		{
			return '<span class="fa fa-fw fa-check-circle green"></span>'.Yii::t('frontend', 'Verified');
		}
		else
		{
			return Yii::t('frontend', 'Connect');
		}
	}
	public static function hourliessales($userid) {

		$name = Yii::$app->db->createCommand("SELECT COUNT(*) as number FROM {{%hourliessales}} WHERE buyer_id = '$userid'");
            $reader = $name->query();
			$dataUser = $reader->readAll();

			return $dataUser['0']['number'];;
	}

	public static function projectscompleted($userid) {

		$name = Yii::$app->db->createCommand("SELECT COUNT(*) as number FROM {{%hourliessales}} WHERE buyer_id = '$userid' AND completed = '1'");
            $reader = $name->query();
			$dataUser = $reader->readAll();

			return $dataUser['0']['number'];;
	}
	public static function jobsawarded($userid) {

		$name = Yii::$app->db->createCommand("SELECT COUNT(*) as number FROM {{%hourliessales}} WHERE buyer_id = '$userid' AND completed = '1'");
            $reader = $name->query();
			$dataUser = $reader->readAll();

			return $dataUser['0']['number'];;
	}
  public static function JobsCreated($userid) {

    $name = Yii::$app->db->createCommand("SELECT COUNT(*) as number FROM {{%job}} WHERE user_id = '$userid'");
            $reader = $name->query();
      $dataUser = $reader->readAll();

      return $dataUser['0']['number'];;
  }
	public static function lastproject($userid) {

		$name = Yii::$app->db->createCommand("SELECT * FROM {{%hourliessales}} WHERE buyer_id = '$userid' AND completed = '1' ORDER BY id DESC");
            $reader = $name->query();
			$dataUser = $reader->readAll();

			if(!empty($dataUser))
				{
					$datecompleted = $dataUser['0']['date_completed'];
					if(isset($datecompleted))
					{
						$timestamp = strtotime($datecompleted);
						return date('j M Y',$timestamp);
					}
					else
					{
						return '';
					}
				}

	}
  public static function MyJobs($userid, $curencysymbol) {
    $jobs = Job::find()->where(['user_id' => $userid])->all();

    foreach ($jobs as $key)
    {
      $jobid = $key['id'];
      $jobTitle = $key['title'];
      $string = preg_replace("/[^\w]+/", "-", $jobTitle);
      $SeoURL =  strtolower($string);
      $JobDesc = $key['description'];
      $budget = $key['budget'];
      $button = Html::a(Yii::t('frontend', 'View'), ['job/'.$SeoURL.'-'.$jobid], ['class' => 'btn btn-warning']);
      $myJobs .= '<div id="profile_listbox"><div class="HourlieTitle">
      <strong><a href="job/'.$SeoURL.'-'.$jobid.'">'.$jobTitle.'</a></strong>
      </div><div class="HourlieCost">'.$curencysymbol . $budget.'</div>
      <div class="contact"><div class="pic">'.Html::img(MyHelpers::IdtoPic($userid), ['class' => 'minipic']).'</div>
      <div class="username">'.MyHelpers::IdToFullName($userid).'</div> <div class="country">'.MyHelpers::IdToCountry($userid).'</div>
      <div class="cnt_button">'.$button.'</div></div></div>';

    }
    return $myJobs;
  }
  public static function MyJobsSelect($userid) {
    $jobs = Job::find()->where(['user_id' => $userid])
    ->andWhere(['freelancer' => '0'])
    ->all();

    $listData=ArrayHelper::map($jobs,'id','title');

    return $listData;
  }
  public static function MyBoughtHourlies($userid, $curencysymbol) {

      $name = Yii::$app->db->createCommand("SELECT * FROM {{%hourliessales}} WHERE buyer_id = '$userid'");
      $reader = $name->query();
      $dataUser = $reader->readAll();
      if(!empty($dataUser))
      {

        $seller_id = $dataUser[0]['seller_id'];
        $account = Yii::$app->db->createCommand("SELECT * FROM {{%user}} WHERE id = '$seller_id'");
        $accountreader = $account->query();
        $accountUser = $accountreader->readAll();
        $profile_pic = $accountUser[0]['profile_picture'];
        $usersname = $accountUser[0]['full_name'];
        $country = $accountUser[0]['country'];


        $myhourlies = '';
      foreach($dataUser as $value)
      {
        $hpicture = Hourlies::find()->where(['id' => $value['item_id']])->one();
        $url = $value['item_name'];
        $string = preg_replace("/[^\w]+/", "-", $url);
        $SeoURL =  strtolower($string);
        $mainIMG = json_decode($hpicture['images']);
        $button = Html::a(Yii::t('frontend', 'View'), ['hourlies/'.$SeoURL.'-'.$value['id']], ['class' => 'btn btn-warning']);

        $myhourlies .= '<div id="profile_listbox"><div class="profile_HourlieImage"><a href="hourlies/'.$SeoURL.'-'.$value['item_id'].'"><img src="'.$mainIMG[0].'" class="profile_hourlies_images"></a></div><div class="HourlieTitle"><strong><a href="hourlies/'.$SeoURL.'-'.$value['item_id'].'">'.$value['item_name'].'</a></strong></div><div class="HourlieCost">'.$curencysymbol . $value['cost'].'</div><div class="contact"><div class="pic">'.Html::img($profile_pic, ['class' => 'minipic']).'</div><div class="username">'.$usersname.'</div> <div class="country">'.$country.'</div><div class="cnt_button">'.$button.'</div></div></div>';
      }
      return $myhourlies;
      }
      else
      {
        return '<div class="portfolio_empty text-center">
                    <p>'.Yii::t('frontend', 'Hey. We noticed you have not bought any Hourlies. Why not try something new?').'</p>
                    <p>'.Html::a('<span class="fa fa-fw fa-camera"></span>'.Yii::t('frontend', 'Browser Hourlies'), ['/hourlies'], ['class' => 'btn btn-success']).'</p>
                  </div>';
      }

  }
	public static function MyHourlies($userid, $curencysymbol) {

			$name = Yii::$app->db->createCommand("SELECT * FROM {{%hourlies}} WHERE user_id = '$userid'");
            $reader = $name->query();
			$dataUser = $reader->readAll();
			if(!empty($dataUser))
			{

			$account = Yii::$app->db->createCommand("SELECT * FROM {{%user}} WHERE id = '$userid'");
      $accountreader = $account->query();
			$accountUser = $accountreader->readAll();
			$profile_pic = $accountUser[0]['profile_picture'];
			$usersname = $accountUser[0]['full_name'];
			$country = $accountUser[0]['country'];
      $myhourlies = '';
			foreach($dataUser as $value)
			{
				$url = $value['title'];
				$string = preg_replace("/[^\w]+/", "-", $url);
				$SeoURL =  strtolower($string);
				$mainIMG = json_decode($value['images']);
				$button = Html::a(Yii::t('frontend', 'View'), ['hourlies/'.$SeoURL.'-'.$value['id']], ['class' => 'btn btn-warning']);

				$myhourlies .= '<div id="profile_listbox"><div class="profile_HourlieImage"><a href="hourlies/'.$SeoURL.'-'.$value['id'].'"><img src="'.$mainIMG[0].'" class="profile_hourlies_images"></a></div><div class="HourlieTitle"><strong><a href="hourlies/'.$SeoURL.'-'.$value['id'].'">'.$value['title'].'</a></strong></div><div class="HourlieCost">'.$curencysymbol . $value['cost'].'</div><div class="contact"><div class="pic">'.Html::img($profile_pic, ['class' => 'minipic']).'</div><div class="username">'.$usersname.'</div> <div class="country">'.$country.'</div><div class="cnt_button">'.$button.'</div></div></div>';
			}
      return $myhourlies;
			}
			else
			{
				return '<div class="portfolio_empty text-center">
										<p>'.Yii::t('frontend', 'Hey. We noticed you don\'t have any active Hourlies. Why not try something new?').'</p>
										<p>'.Html::a('<span class="fa fa-fw fa-camera"></span>'.Yii::t('frontend', 'Post Hourlie'), ['hourlies/create'], ['class' => 'btn btn-success']).'</p>
									</div>';
			}

	}

	public static function MyHourliesPublic($userid) {

			$name = Yii::$app->db->createCommand("SELECT * FROM {{%hourlies}} WHERE user_id = '$userid'");
            $reader = $name->query();
			$dataUser = $reader->readAll();
			if(!empty($dataUser))
			{

			$account = Yii::$app->db->createCommand("SELECT * FROM {{%user}} WHERE id = '$userid'");
      $accountreader = $account->query();
			$accountUser = $accountreader->readAll();
			$profile_pic = $accountUser[0]['profile_picture'];
			$usersname = $accountUser[0]['full_name'];
			$country = $accountUser[0]['country'];
      $myhourlies ='';
			foreach($dataUser as $value)
			{
				$url = $value['title'];
				$string = preg_replace("/[^\w]+/", "-", $url);
				$SeoURL =  strtolower($string);

        $mainIMG = json_decode($value['images']);
				$button = Html::a("View", ['../hourlies/'.$SeoURL.'-'.$value['id']], ['class' => 'btn btn-warning']);

				$myhourlies .= '<div id="profile_listbox"><div class="profile_HourlieImage"><a href="../hourlies/'.$SeoURL.'-'.$value['id'].'"><img src="'.$mainIMG[0].'" class="profile_hourlies_images"></a></div><div class="HourlieTitle"><strong><a href="hourlies/'.$SeoURL.'-'.$value['id'].'">'.$value['title'].'</a></strong></div><div class="HourlieCost">'.$value['cost'].'</div><div class="contact"><div class="pic">'.Html::img($profile_pic, ['class' => 'minipic']).'</div><div class="username">'.$usersname.'</div> <div class="country">'.$country.'</div><div class="cnt_button">'.$button.'</div></div></div>';
			}
      return $myhourlies;
			}
			else
			{
				return '<div class="portfolio_empty text-center">
										<p>'.Yii::t('frontend', 'I currently have no Hourlies').'</p>

									</div>';
			}

	}
  public static function HourlieIdtoName($id) {
  $name = Yii::$app->db->createCommand("SELECT * FROM {{%hourlies}} WHERE id = '$id'");
  $reader = $name->query();
    $dataUser = $reader->readAll();
    return $dataUser['0']['title'];
}
public static function HourlieSalesIdtoName($id) {
$name = Yii::$app->db->createCommand("SELECT * FROM {{%hourliessales}} WHERE id = '$id'");
$reader = $name->query();
  $dataUser = $reader->readAll();
  return $dataUser['0']['item_name'];
}
public static function JobIdtoName($id) {
$name = Yii::$app->db->createCommand("SELECT * FROM {{%job}} WHERE id = '$id'");
$reader = $name->query();
  $dataUser = $reader->readAll();
  return $dataUser['0']['title'];
}
	public static function myPortFolio($portfolio)
	{
		$portfolio = json_decode($portfolio, true);
								if(!empty($portfolio))
								{
                  $listportfolio='';
									foreach($portfolio as $value)
									{
										$listportfolio .= '<a href="'.$value.'" rel="prettyPhoto" class="lightbox"><img src="'.$value.'" class="portfolio_images img-thumbnail"></a>';
									}
                  return $listportfolio;
								}
								else
								{
									return '<div class="portfolio_empty text-center">
										<p>'.Yii::t('frontend', 'Upload a portfolio to impress buyers').'</p>
										<p>'.Html::a('<span class="fa fa-fw fa-camera"></span>'.Yii::t('frontend', 'Upload portfolio'), ['update'], ['class' => 'btn btn-success']).'</p>
									</div>';
								}
	}
	public static function myPortFolioPublic($portfolio)
	{
		$portfolio = json_decode($portfolio, true);
								if(!empty($portfolio))
								{
                  $listportfolio='';
									foreach($portfolio as $value)
									{
										$listportfolio .= '<a href="'.$value.'" rel="prettyPhoto" class="lightbox"><img src="'.$value.'" class="portfolio_images img-thumbnail"></a>';
									}
                  return $listportfolio;
								}
								else
								{
									return '<div class="portfolio_empty text-center">
										<p>'.Yii::t('frontend', 'I currently have no portfolio').'</p>

									</div>';
								}
	}
	public static function timeAgo($timestamp){
    $datetime1=new \DateTime("now");
    $datetime2=date_create($timestamp);
    $diff=date_diff($datetime1, $datetime2);
    $timemsg='';
    if($diff->y > 0){
        $timemsg = $diff->y .' '.Yii::t('frontend', 'year'). ($diff->y > 1?"'s":'');

    }
    else if($diff->m > 0){
     $timemsg = $diff->m .' '. Yii::t('frontend', 'month'). ($diff->m > 1?"'s":'');
    }
    else if($diff->d > 0){
     $timemsg = $diff->d .' '.Yii::t('frontend', 'day'). ($diff->d > 1?"'s":'');
    }
    else if($diff->h > 0){
     $timemsg = $diff->h .' '.Yii::t('frontend', 'hour').($diff->h > 1 ? "'s":'');
    }
    else if($diff->i > 0){
     $timemsg = $diff->i .' '.Yii::t('frontend', 'minute'). ($diff->i > 1?"'s":'');
    }
    else if($diff->s > 0){
     $timemsg = $diff->s .' '.Yii::t('frontend', 'second'). ($diff->s > 1?"'s":'');
    }

     $timemsg = $timemsg;
     return $timemsg;
   }

   public static function detectCardType($num)
 {
    $re = array(
        "visa"       => "/^4[0-9]{12}(?:[0-9]{3})?$/",
        "mastercard" => "/^5[1-5][0-9]{14}$/",
        "amex"       => "/^3[47][0-9]{13}$/",
		    "maestro"	   => "/^(5018|5020|5038|6304|6759|6761|676[23]|0604)[0-9]{8,15}$/",
		    "jcb"		     => "/^(?:2131|1800|35[0-9]{3})[0-9]{11}$/",
        "discover"   => "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
		    "diners" 	   => "/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/",
    );

    if (preg_match($re['visa'],$num))
    {
        return 'visa';
    }
    else if (preg_match($re['mastercard'],$num))
    {
        return 'mastercard';
    }
    else if (preg_match($re['amex'],$num))
    {
        return 'amex';
    }
    else if (preg_match($re['discover'],$num))
    {
        return 'discover';
    }
	else if (preg_match($re['jcb'],$num))
    {
        return 'jcb';
    }
    else
    {
        return false;
    }
 }
 public static function doSplitName($name)
{
    $results = array();

    $r = explode(' ', $name);
    $size = count($r);

    //check first for period, assume salutation if so
    if (mb_strpos($r[0], '.') === false)
    {
        $results['salutation'] = '';
        $results['first'] = $r[0];
    }
    else
    {
        $results['salutation'] = $r[0];
        $results['first'] = $r[1];
    }

    //check last for period, assume suffix if so
    if (mb_strpos($r[$size - 1], '.') === false)
    {
        $results['suffix'] = '';
    }
    else
    {
        $results['suffix'] = $r[$size - 1];
    }

    //combine remains into last
    $start = ($results['salutation']) ? 2 : 1;
    $end = ($results['suffix']) ? $size - 2 : $size - 1;

    $last = '';
    for ($i = $start; $i <= $end; $i++)
    {
        $last .= ' '.$r[$i];
    }
    $results['last'] = trim($last);

    return $results;
  }

//Admin general functions

//Total earnings from paid transactions completed or incomplete but paid for
  public static function TotalEarnings()
  {
    $HourlieSales = Hourliessales::find()->where(['paid_status' => 'Success'])->sum('total_cost');
    $JobSales = Job::find()->where(['paid' => '1'])->sum('agreed_price');
    $sum = $HourlieSales + $JobSales;

    return money_format('%.2n', $sum);;

  }
  public static function PendingTransactionSum()
  {
    $HourlieSales = Hourliessales::find()->where(['paid_status' => 'Pending'])->sum('total_cost');
    $JobSales = Job::find()->where(['paid' => '0'])->sum('agreed_price');
    $sum = $HourlieSales + $JobSales;

    return money_format('%.2n', $sum);;

  }
  public static function SiteRevenue()
  {
    $HourlieSales = Hourliessales::find()->where(['paid_status' => 'Success'])->sum('our_commission');
    $JobSales = Job::find()->where(['paid' => '1'])->sum('our_commission');
    $sum = $HourlieSales + $JobSales;

    return money_format('%.2n', $sum);;

  }
  public static function PendingPayouts()
  {
    $HourlieSales = Hourliessales::find()->where(['paid_status' => 'Success'])
                                         ->andwhere(['completed' => '1'])
                                         ->andwhere(['released_escro' => '1'])
                                         ->andWhere(['freelancer_paid' => '0'])
                                         ->sum('totalaftercommission');
    $JobSales = Job::find()->where(['paid' => '1'])
                           ->andwhere(['success' => '1'])
                           ->andwhere(['released_escro' => '1'])
                           ->andWhere(['freelancer_paid' => '0'])
                           ->sum('totalaftercommission');

    $sum = $HourlieSales + $JobSales;

    return money_format('%.2n', $sum);;

  }
}
