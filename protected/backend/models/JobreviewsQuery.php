<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Jobreviews]].
 *
 * @see Jobreviews
 */
class JobreviewsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Jobreviews[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Jobreviews|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
