<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Invite]].
 *
 * @see Invite
 */
class InviteQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Invite[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Invite|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
