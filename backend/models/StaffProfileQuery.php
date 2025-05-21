<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StaffProfile]].
 *
 * @see StaffProfile
 */
class StaffProfileQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StaffProfile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StaffProfile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
