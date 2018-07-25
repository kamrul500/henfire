<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[JobProposals]].
 *
 * @see JobProposals
 */
class JobProposalsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return JobProposals[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return JobProposals|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
