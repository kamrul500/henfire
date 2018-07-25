<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Hourliessales]].
 *
 * @see Hourliessales
 */
class HourliessalesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Hourliessales[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Hourliessales|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
