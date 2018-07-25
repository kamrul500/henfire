<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PaymentRequests]].
 *
 * @see PaymentRequests
 */
class PaymentRequestsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PaymentRequests[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PaymentRequests|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
