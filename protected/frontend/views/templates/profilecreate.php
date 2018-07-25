<?php
use yii\helpers\Html;
$this->title = 'Create User';
?>
<div class="container">
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('profile_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
