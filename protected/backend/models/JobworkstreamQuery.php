<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Jobworkstream]].
 *
 * @see Jobworkstream
 */
class JobworkstreamQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Jobworkstream[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Jobworkstream|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
