<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PhoneNumber]].
 *
 * @see PhoneNumber
 */
class PhoneNumberQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PhoneNumber[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PhoneNumber|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
