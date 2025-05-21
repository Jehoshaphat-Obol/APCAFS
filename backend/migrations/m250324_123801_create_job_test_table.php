<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%job_test}}`.
 */
class m250324_123801_create_job_test_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%job_test}}', [
            'id' => $this->primaryKey(),
            'test_company_id' => $this->integer()->notNull(),
            'test_job_post_id' => $this->integer()->notNull(),
            'test_user_id' => $this->integer()->notNull()->defaultValue(null), // hii ni id ya mtengeneza hii test
            'test_identification' => $this->string(30)->notNull(),
            'test_duration' => $this->integer()->notNull(),
            'test_status_id' => $this->integer()->notNull(),
            'test_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'test_created_by' => $this->integer()->defaultValue(null),
            'test_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'test_updated_by' => $this->integer()->defaultValue(null),
            'test_deleted_at' => $this->timestamp()->defaultValue(null),
            'test_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-unique-test_company-job_post-user-identification}}',
            '{{%job_test}}',
            ['test_company_id', 'test_job_post_id', 'test_user_id', 'test_identification'],
            true // Hii inaweka unique index
        );

        $this->createIndex(
            '{{%idx-job_test-test_company_id}}',
            '{{%job_test}}',
            'test_company_id'
        );

        $this->addForeignKey(
            '{{%fk-job_test-test_company_id}}',
            '{{%job_test}}',
            'test_company_id',
            '{{%company}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-job_test-test_job_post_id}}',
            '{{%job_test}}',
            'test_job_post_id'
        );

        $this->addForeignKey(
            '{{%fk-job_test-test_job_post_id}}',
            '{{%job_test}}',
            'test_job_post_id',
            '{{%job_post}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-job_test-test_user_id}}',
            '{{%job_test}}',
            'test_user_id'
        );

        $this->addForeignKey(
            '{{%fk-job_test-test_user_id}}',
            '{{%job_test}}',
            'test_user_id',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-job_test-test_status_id}}',
            '{{%job_test}}',
            'test_status_id'
        );

        $this->addForeignKey(
            '{{%fk-job_test-test_status_id}}',
            '{{%job_test}}',
            'test_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-job_test-test_created_by}}',
            '{{%job_test}}',
            'test_created_by'
        );

        $this->addForeignKey(
            '{{%fk-job_test-test_created_by}}',
            '{{%job_test}}',
            'test_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-job_test-test_updated_by}}',
            '{{%job_test}}',
            'test_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-job_test-test_updated_by}}',
            '{{%job_test}}',
            'test_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-job_test-test_deleted_by}}',
            '{{%job_test}}',
            'test_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-job_test-test_deleted_by}}',
            '{{%job_test}}',
            'test_deleted_by',
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
            '{{%fk-job_test-test_deleted_by}}',
            '{{%job_test}}'
        );

        $this->dropIndex(
            '{{%idx-job_test-test_deleted_by}}',
            '{{%job_test}}'
        );

        $this->dropForeignKey(
            '{{%fk-job_test-test_updated_by}}',
            '{{%job_test}}'
        );

        $this->dropIndex(
            '{{%idx-job_test-test_updated_by}}',
            '{{%job_test}}'
        );

        $this->dropForeignKey(
            '{{%fk-job_test-test_created_by}}',
            '{{%job_test}}'
        );

        $this->dropIndex(
            '{{%idx-job_test-test_created_by}}',
            '{{%job_test}}'
        );

        $this->dropForeignKey(
            '{{%fk-job_test-test_status_id}}',
            '{{%job_test}}'
        );

        $this->dropIndex(
            '{{%idx-job_test-test_status_id}}',
            '{{%job_test}}'
        );

        $this->dropForeignKey(
            '{{%fk-job_test-test_user_id}}',
            '{{%job_test}}'
        );

        $this->dropIndex(
            '{{%idx-job_test-test_user_id}}',
            '{{%job_test}}'
        );

        $this->dropForeignKey(
            '{{%fk-job_test-test_job_post_id}}',
            '{{%job_test}}'
        );

        $this->dropIndex(
            '{{%idx-job_test-test_job_post_id}}',
            '{{%job_test}}'
        );
        
        $this->dropForeignKey(
            '{{%fk-job_test-test_company_id}}',
            '{{%job_test}}'
        );

        $this->dropIndex(
            '{{%idx-job_test-test_company_id}}',
            '{{%job_test}}'
        );

        $this->dropIndex(
            '{{%idx-unique-test_company-job_post-user-identification}}',
            '{{%job_test}}'
        );

        $this->dropTable('{{%job_test}}');
    }
}
