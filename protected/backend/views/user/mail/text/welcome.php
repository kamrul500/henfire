<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var dektrium\user\models\User
 */
 use common\components\MyHelpers;
?>
<?= Yii::t('frontend', 'Hello') ?>,

<?= Yii::t('frontend', 'Your account on {0} has been created', MyHelpers::WebsiteName()) ?>.
<?php if ($module->enableGeneratingPassword): ?>
<?= Yii::t('frontend', 'We have generated a password for you') ?>:
<?= $user->password ?>
<?php endif ?>

<?php if ($token !== null): ?>
<?= Yii::t('frontend', 'In order to complete your registration, please click the link below') ?>.

<?= $token->url ?>

<?= Yii::t('frontend', 'If you cannot click the link, please try pasting the text into your browser') ?>.
<?php endif ?>

<?= Yii::t('frontend', 'If you did not make this request you can ignore this email') ?>.
