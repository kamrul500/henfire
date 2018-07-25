<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AppsCountries]].
 *
 * @see AppsCountries
 */
class AppsCountriesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AppsCountries[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AppsCountries|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
