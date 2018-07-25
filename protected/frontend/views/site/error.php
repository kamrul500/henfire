<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<aside id="fh5co-hero" class="fh5co-cover" role="banner" style="background-image:url(<?= Html::encode(Yii::$app->homeUrl);?>assets/images/polygon-bg.jpg);">
    <div class="overlay-gradient"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">

            <div class="error-logo pull-left">
              <img src="<?= Html::encode(Yii::$app->homeUrl);?>assets/images/woops-text.png">

              <div class="errortexth">
                <p class="errortext">This isn't a page we really intended upon you to stop by. There are scary zombies running around here, and you really shouldn't be walking by these places all by yourself.</p>

              <p>In case you mistyped a URL or something, try typing the right one very slowly. If you clicked on a link, either within our site or from outside, fret not - get back to the safety of the home page and you should be ok. Here are some safe places you should jump to right away:</p>
             <img src="<?= Html::encode(Yii::$app->homeUrl);?>assets/images/zombi_tree.png" class="zombie">
            </div>
            </div>

              <div class="row">

              </div>
            </div>

        </div>
      </div>
    </div>
  </aside>
