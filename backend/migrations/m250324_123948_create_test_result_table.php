<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test_result}}`.
 */
class m250324_123948_create_test_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%test_result}}', [
            'id' => $this->primaryKey(),
            'result_company_id' => $this->integer()->notNull(),
            'result_test_id' => $this->integer()->notNull(),
            'result_user_id' => $this->integer()->notNull(), // hii ni id ya applicant
            'result_score' => $this->decimal(3,2)->notNull(),
            'result_status_id' => $this->integer()->notNull(),
            'result_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'result_created_by' => $this->integer()->defaultValue(null),
            'result_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'result_updated_by' => $this->integer()->defaultValue(null),
            'result_deleted_at' => $this->timestamp()->defaultValue(null),
            'result_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-test_result-result_company_id}}',
            '{{%test_result}}',
            'result_company_id'
        );

        $this->addForeignKey(
            '{{%fk-test_result-result_company_id}}',
            '{{%test_result}}',
            'result_company_id',
            '{{%company}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-test_result-result_test_id}}',
            '{{%test_result}}',
            'result_test_id'
        );

        $this->addForeignKey(
            '{{%fk-test_result-result_test_id}}',
            '{{%test_result}}',
            'result_test_id',
            '{{%job_test}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-test_result-result_user_id}}',
            '{{%test_result}}',
            'result_user_id'
        );

        $this->addForeignKey(
            '{{%fk-test_result-result_user_id}}',
            '{{%test_result}}',
            'result_user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-test_result-result_status_id}}',
            '{{%test_result}}',
            'result_status_id'
        );

        $this->addForeignKey(
            '{{%fk-test_result-result_status_id}}',
            '{{%test_result}}',
            'result_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-test_result-result_created_by}}',
            '{{%test_result}}',
            'result_created_by'
        );

        $this->addForeignKey(
            '{{%fk-test_result-result_created_by}}',
            '{{%test_result}}',
            'result_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-test_result-result_updated_by}}',
            '{{%test_result}}',
            'result_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-test_result-result_updated_by}}',
            '{{%test_result}}',
            'result_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-test_result-result_deleted_by}}',
            '{{%test_result}}',
            'result_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-test_result-result_deleted_by}}',
            '{{%test_result}}',
            'result_deleted_by',
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
            '{{%fk-test_result-result_deleted_by}}',
            '{{%test_result}}'
        );

        $this->dropIndex(
            '{{%idx-test_result-result_deleted_by}}',
            '{{%test_result}}'
        );

        $this->dropForeignKey(
            '{{%fk-test_result-result_updated_by}}',
            '{{%test_result}}'
        );

        $this->dropIndex(
            '{{%idx-test_result-result_updated_by}}',
            '{{%test_result}}'
        );

        $this->dropForeignKey(
            '{{%fk-test_result-result_created_by}}',
            '{{%test_result}}'
        );

        $this->dropIndex(
            '{{%idx-test_result-result_created_by}}',
            '{{%test_result}}'
        );

        $this->dropForeignKey(
            '{{%fk-test_result-result_status_id}}',
            '{{%test_result}}'
        );

        $this->dropIndex(
            '{{%idx-test_result-result_status_id}}',
            '{{%test_result}}'
        );

        $this->dropForeignKey(
            '{{%fk-test_result-result_user_id}}',
            '{{%test_result}}'
        );

        $this->dropIndex(
            '{{%idx-test_result-result_user_id}}',
            '{{%test_result}}'
        );

        $this->dropForeignKey(
            '{{%fk-test_result-result_test_id}}',
            '{{%test_result}}'
        );

        $this->dropIndex(
            '{{%idx-test_result-result_test_id}}',
            '{{%test_result}}'
        );
        
        $this->dropForeignKey(
            '{{%fk-test_result-result_company_id}}',
            '{{%test_result}}'
        );

        $this->dropIndex(
            '{{%idx-test_result-result_company_id}}',
            '{{%test_result}}'
        );

        $this->dropTable('{{%test_result}}');
    }
}
