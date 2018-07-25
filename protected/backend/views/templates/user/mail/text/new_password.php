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

<?= Yii::t('frontend', 'Your account on {0} has a new password', MyHelpers::WebsiteName()) ?>.
<?= Yii::t('frontend', 'We have generated a password for you') ?>:
<?= $user->password ?>

<?= Yii::t('frontend', 'If you did not make this request you can ignore this email') ?>.
