<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Jobworkflow]].
 *
 * @see Jobworkflow
 */
class JobworkflowQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Jobworkflow[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Jobworkflow|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
