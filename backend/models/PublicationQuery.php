<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Publication]].
 *
 * @see Publication
 */
class PublicationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Publication[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Publication|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
