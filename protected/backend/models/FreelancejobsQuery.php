<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Freelancejobs]].
 *
 * @see Freelancejobs
 */
class FreelancejobsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Freelancejobs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Freelancejobs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
