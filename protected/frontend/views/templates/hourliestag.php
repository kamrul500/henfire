<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SkillsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Skills';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]);?>

 <div class="boxes">
    <?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_grids/_skills',
    'itemOptions' => ['class' => 'itemlist'],
    'layout' => '{items}<div>{pager}</div>',

]); ?>
</div>

<div>This is some text right here</div>
</div>
