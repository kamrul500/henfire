<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */

$this->title = 'Settings'

?>
<div class="settings-update">

      <?= $this->render('_form', [
        'model' => $model,
        ]) ?>

</div>
