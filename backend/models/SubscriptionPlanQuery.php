<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SubscriptionPlan]].
 *
 * @see SubscriptionPlan
 */
class SubscriptionPlanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SubscriptionPlan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SubscriptionPlan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
