<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[WorkExperience]].
 *
 * @see WorkExperience
 */
class WorkExperienceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return WorkExperience[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return WorkExperience|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
