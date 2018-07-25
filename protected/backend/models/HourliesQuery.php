<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Hourlies]].
 *
 * @see Hourlies
 */
class HourliesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Hourlies[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Hourlies|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
