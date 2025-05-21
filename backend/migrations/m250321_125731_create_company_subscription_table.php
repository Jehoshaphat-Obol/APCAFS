<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_subscription}}`.
 */
class m250321_125731_create_company_subscription_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company_subscription}}', [
            'id' => $this->primaryKey(),
            'subscription_company_id' => $this->integer()->notNull(),
            'subscription_plan_id' => $this->integer()->notNull(),
            'subscription_start_date' => $this->date()->notNull(),
            'subscription_end_date' => $this->date()->notNull(),
            'subscription_status_id' => $this->integer()->notNull(),
            'subscription_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'subscription_created_by' => $this->integer()->defaultValue(null),
            'subscription_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'subscription_updated_by' => $this->integer()->defaultValue(null),
            'subscription_deleted_at' => $this->timestamp()->defaultValue(null),
            'subscription_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-company_subscription-subscription_company_id}}',
            '{{%company_subscription}}',
            'subscription_company_id'
        );

        $this->addForeignKey(
            '{{%fk-company_subscription-subscription_company_id}}',
            '{{%company_subscription}}',
            'subscription_company_id',
            '{{%company}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-company_subscription-subscription_plan_id}}',
            '{{%company_subscription}}',
            'subscription_plan_id'
        );

        $this->addForeignKey(
            '{{%fk-company_subscription-subscription_plan_id}}',
            '{{%company_subscription}}',
            'subscription_plan_id',
            '{{%subscription_plan}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-company_subscription-subscription_status_id}}',
            '{{%company_subscription}}',
            'subscription_status_id'
        );

        $this->addForeignKey(
            '{{%fk-company_subscription-subscription_status_id}}',
            '{{%company_subscription}}',
            'subscription_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-company_subscription-subscription_created_by}}',
            '{{%company_subscription}}',
            'subscription_created_by'
        );

        $this->addForeignKey(
            '{{%fk-company_subscription-subscription_created_by}}',
            '{{%company_subscription}}',
            'subscription_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-company_subscription-subscription_updated_by}}',
            '{{%company_subscription}}',
            'subscription_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-company_subscription-subscription_updated_by}}',
            '{{%company_subscription}}',
            'subscription_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-company_subscription-subscription_deleted_by}}',
            '{{%company_subscription}}',
            'subscription_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-company_subscription-subscription_deleted_by}}',
            '{{%company_subscription}}',
            'subscription_deleted_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-company_subscription-subscription_deleted_by}}',
            '{{%company_subscription}}'
        );

        $this->dropIndex(
            '{{%idx-company_subscription-subscription_deleted_by}}',
            '{{%company_subscription}}'
        );

        $this->dropForeignKey(
            '{{%fk-company_subscription-subscription_updated_by}}',
            '{{%company_subscription}}'
        );

        $this->dropIndex(
            '{{%idx-company_subscription-subscription_updated_by}}',
            '{{%company_subscription}}'
        );

        $this->dropForeignKey(
            '{{%fk-company_subscription-subscription_created_by}}',
            '{{%company_subscription}}'
        );

        $this->dropIndex(
            '{{%idx-company_subscription-subscription_created_by}}',
            '{{%company_subscription}}'
        );

        $this->dropForeignKey(
            '{{%fk-company_subscription-subscription_status_id}}',
            '{{%company_subscription}}'
        );

        $this->dropIndex(
            '{{%idx-company_subscription-subscription_status_id}}',
            '{{%company_subscription}}'
        );

        $this->dropForeignKey(
            '{{%fk-company_subscription-subscription_plan_id}}',
            '{{%company_subscription}}'
        );

        $this->dropIndex(
            '{{%idx-company_subscription-subscription_plan_id}}',
            '{{%company_subscription}}'
        );
        
        $this->dropForeignKey(
            '{{%fk-company_subscription-subscription_company_id}}',
            '{{%company_subscription}}'
        );

        $this->dropIndex(
            '{{%idx-company_subscription-subscription_company_id}}',
            '{{%company_subscription}}'
        );

        $this->dropTable('{{%company_subscription}}');
    }
}
