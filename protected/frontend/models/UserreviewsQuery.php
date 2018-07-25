<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Userreviews]].
 *
 * @see Userreviews
 */
class UserreviewsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Userreviews[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Userreviews|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
