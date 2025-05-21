<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TestResult]].
 *
 * @see TestResult
 */
class TestResultQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TestResult[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TestResult|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
