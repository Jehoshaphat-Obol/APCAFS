<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test_question}}`.
 */
class m250324_123834_create_test_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%test_question}}', [
            'id' => $this->primaryKey(),
            'question_company_id' => $this->integer()->notNull(),
            'question_test_id' => $this->integer()->notNull(),
            'question' => $this->text()->notNull(),
            'question_status_id' => $this->integer()->notNull(),
            'question_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'question_created_by' => $this->integer()->defaultValue(null),
            'question_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'question_updated_by' => $this->integer()->defaultValue(null),
            'question_deleted_at' => $this->timestamp()->defaultValue(null),
            'question_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-unique-question_company-test-question}}',
            '{{%test_question}}',
            ['question_company_id', 'question_test_id', 'question'],
            true // Hii inaweka unique index
        );

        $this->createIndex(
            '{{%idx-test_question-question_company_id}}',
            '{{%test_question}}',
            'question_company_id'
        );

        $this->addForeignKey(
            '{{%fk-test_question-question_company_id}}',
            '{{%test_question}}',
            'question_company_id',
            '{{%company}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-test_question-question_test_id}}',
            '{{%test_question}}',
            'question_test_id'
        );

        $this->addForeignKey(
            '{{%fk-test_question-question_test_id}}',
            '{{%test_question}}',
            'question_test_id',
            '{{%job_test}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-test_question-question_status_id}}',
            '{{%test_question}}',
            'question_status_id'
        );

        $this->addForeignKey(
            '{{%fk-test_question-question_status_id}}',
            '{{%test_question}}',
            'question_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-test_question-question_created_by}}',
            '{{%test_question}}',
            'question_created_by'
        );

        $this->addForeignKey(
            '{{%fk-test_question-question_created_by}}',
            '{{%test_question}}',
            'question_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-test_question-question_updated_by}}',
            '{{%test_question}}',
            'question_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-test_question-question_updated_by}}',
            '{{%test_question}}',
            'question_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-test_question-question_deleted_by}}',
            '{{%test_question}}',
            'question_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-test_question-question_deleted_by}}',
            '{{%test_question}}',
            'question_deleted_by',
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
            '{{%fk-test_question-question_deleted_by}}',
            '{{%test_question}}'
        );

        $this->dropIndex(
            '{{%idx-test_question-question_deleted_by}}',
            '{{%test_question}}'
        );

        $this->dropForeignKey(
            '{{%fk-test_question-question_updated_by}}',
            '{{%test_question}}'
        );

        $this->dropIndex(
            '{{%idx-test_question-question_updated_by}}',
            '{{%test_question}}'
        );

        $this->dropForeignKey(
            '{{%fk-test_question-question_created_by}}',
            '{{%test_question}}'
        );

        $this->dropIndex(
            '{{%idx-test_question-question_created_by}}',
            '{{%test_question}}'
        );

        $this->dropForeignKey(
            '{{%fk-test_question-question_status_id}}',
            '{{%test_question}}'
        );

        $this->dropIndex(
            '{{%idx-test_question-question_status_id}}',
            '{{%test_question}}'
        );

        $this->dropForeignKey(
            '{{%fk-test_question-question_test_id}}',
            '{{%test_question}}'
        );

        $this->dropIndex(
            '{{%idx-test_question-question_test_id}}',
            '{{%test_question}}'
        );
        
        $this->dropForeignKey(
            '{{%fk-test_question-question_company_id}}',
            '{{%test_question}}'
        );

        $this->dropIndex(
            '{{%idx-test_question-question_company_id}}',
            '{{%test_question}}'
        );

        $this->dropIndex(
            '{{%idx-unique-question_company-test-question}}',
            '{{%test_question}}'
        );

        $this->dropTable('{{%test_question}}');
    }
}
