<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[JobCategory]].
 *
 * @see JobCategory
 */
class JobCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     *
     * @return JobCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     *
     * @return JobCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
