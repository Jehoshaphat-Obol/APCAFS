<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test_question_choice}}`.
 */
class m250421_112931_create_test_question_choice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%test_question_choice}}', [
            'id' => $this->primaryKey(),
            'choice_company_id' => $this->integer()->notNull(),
            'choice_question_id' => $this->integer()->notNull(),
            'choice_label' => $this->string(1)->notNull(), // A, B, C, D
            'choice_text' => $this->text()->notNull(),
            'choice_is_correct' => $this->boolean()->notNull()->defaultValue(false), // True/False
            'choice_status_id' => $this->integer()->notNull(),
            'choice_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'choice_created_by' => $this->integer()->defaultValue(null),
            'choice_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'choice_updated_by' => $this->integer()->defaultValue(null),
            'choice_deleted_at' => $this->timestamp()->defaultValue(null),
            'choice_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-test_question_choice-choice_company_id}}',
            '{{%test_question_choice}}',
            'choice_company_id'
        );

        $this->addForeignKey(
            '{{%fk-test_question_choice-choice_company_id}}',
            '{{%test_question_choice}}',
            'choice_company_id',
            '{{%company}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-test_question_choice-choice_question_id}}',
            '{{%test_question_choice}}',
            'choice_question_id'
        );

        $this->addForeignKey(
            '{{%fk-test_question_choice-choice_question_id}}',
            '{{%test_question_choice}}',
            'choice_question_id',
            '{{%test_question}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-test_question_choice-choice_status_id}}',
            '{{%test_question_choice}}',
            'choice_status_id'
        );

        $this->addForeignKey(
            '{{%fk-test_question_choice-choice_status_id}}',
            '{{%test_question_choice}}',
            'choice_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-test_question_choice-choice_created_by}}',
            '{{%test_question_choice}}',
            'choice_created_by'
        );

        $this->addForeignKey(
            '{{%fk-test_question_choice-choice_created_by}}',
            '{{%test_question_choice}}',
            'choice_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-test_question_choice-choice_updated_by}}',
            '{{%test_question_choice}}',
            'choice_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-test_question_choice-choice_updated_by}}',
            '{{%test_question_choice}}',
            'choice_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-test_question_choice-choice_deleted_by}}',
            '{{%test_question_choice}}',
            'choice_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-test_question_choice-choice_deleted_by}}',
            '{{%test_question_choice}}',
            'choice_deleted_by',
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
            '{{%fk-test_question_choice-choice_deleted_by}}',
            '{{%test_question_choice}}'
        );

        $this->dropIndex(
            '{{%idx-test_question_choice-choice_deleted_by}}',
            '{{%test_question_choice}}'
        );

        $this->dropForeignKey(
            '{{%fk-test_question_choice-choice_updated_by}}',
            '{{%test_question_choice}}'
        );

        $this->dropIndex(
            '{{%idx-test_question_choice-choice_updated_by}}',
            '{{%test_question_choice}}'
        );

        $this->dropForeignKey(
            '{{%fk-test_question_choice-choice_created_by}}',
            '{{%test_question_choice}}'
        );

        $this->dropIndex(
            '{{%idx-test_question_choice-choice_created_by}}',
            '{{%test_question_choice}}'
        );

        $this->dropForeignKey(
            '{{%fk-test_question_choice-choice_status_id}}',
            '{{%test_question_choice}}'
        );

        $this->dropIndex(
            '{{%idx-test_question_choice-choice_status_id}}',
            '{{%test_question_choice}}'
        );

        $this->dropForeignKey(
            '{{%fk-test_question_choice-choice_question_id}}',
            '{{%test_question_choice}}'
        );

        $this->dropIndex(
            '{{%idx-test_question_choice-choice_question_id}}',
            '{{%test_question_choice}}'
        );
        
        $this->dropForeignKey(
            '{{%fk-test_question_choice-choice_company_id}}',
            '{{%test_question_choice}}'
        );

        $this->dropIndex(
            '{{%idx-test_question_choice-choice_company_id}}',
            '{{%test_question_choice}}'
        );

        $this->dropTable('{{%test_question_choice}}');
    }
}
