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
 * @var dektrium\user\models\User   $user
 * @var dektrium\user\models\Token  $token
 */
 use common\components\MyHelpers;
?>
<?= Yii::t('frontend', 'Hello') ?>,

<?= Yii::t('frontend', 'Thank you for signing up on {0}', MyHelpers::Websitename()) ?>.
<?= Yii::t('frontend', 'In order to complete your registration, please click the link below') ?>.

<?= $token->url ?>

<?= Yii::t('frontend', 'If you cannot click the link, please try pasting the text into your browser') ?>.

<?= Yii::t('frontend', 'If you did not make this request you can ignore this email') ?>.
