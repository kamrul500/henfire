<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Deposits]].
 *
 * @see Deposits
 */
class DepositsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Deposits[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Deposits|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
