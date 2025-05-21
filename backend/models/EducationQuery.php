<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Education]].
 *
 * @see Education
 */
class EducationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Education[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Education|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
