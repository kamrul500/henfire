<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Hourlieworkflow]].
 *
 * @see Hourlieworkflow
 */
class HourlieworkflowQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Hourlieworkflow[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Hourlieworkflow|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
