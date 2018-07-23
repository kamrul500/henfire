<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Hourlieworkstream]].
 *
 * @see Hourlieworkstream
 */
class HourlieworkstreamQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Hourlieworkstream[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Hourlieworkstream|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
