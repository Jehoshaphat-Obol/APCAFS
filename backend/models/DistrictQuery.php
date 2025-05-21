<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[District]].
 *
 * @see District
 */
class DistrictQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return District[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return District|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
