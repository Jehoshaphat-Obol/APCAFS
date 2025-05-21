<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StatusLookup]].
 *
 * @see StatusLookup
 */
class StatusLookupQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StatusLookup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StatusLookup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
