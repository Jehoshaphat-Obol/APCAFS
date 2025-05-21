<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscription_plan}}`.
 */
class m250321_125657_create_subscription_plan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subscription_plan}}', [
            'id' => $this->primaryKey(),
            'subscription_plan_duration' => $this->integer()->notNull()->defaultValue(1), // Store the duration as integer
            'subscription_plan_duration_type' => $this->string(10)->notNull()->defaultValue('months'), // Changed ENUM to string
            'subscription_plan_status_id' => $this->integer()->notNull(),
            'subscription_plan_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'subscription_plan_created_by' => $this->integer()->defaultValue(null),
            'subscription_plan_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'subscription_plan_updated_by' => $this->integer()->defaultValue(null),
            'subscription_plan_deleted_at' => $this->timestamp()->defaultValue(null),
            'subscription_plan_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-subscription_plan-subscription_plan_status_id}}',
            '{{%subscription_plan}}',
            'subscription_plan_status_id'
        );

        $this->addForeignKey(
            '{{%fk-subscription_plan-subscription_plan_status_id}}',
            '{{%subscription_plan}}',
            'subscription_plan_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-subscription_plan-subscription_plan_status_id}}',
            '{{%subscription_plan}}'
        );

        $this->dropIndex(
            '{{%idx-subscription_plan-subscription_plan_status_id}}',
            '{{%subscription_plan}}'
        );

        $this->dropTable('{{%subscription_plan}}');
    }
}
