<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%language}}`.
 */
class m250324_010455_create_language_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%language}}', [
            'id' => $this->primaryKey(),
            'language_profile_id' => $this->integer()->notNull(),
            'language_name' => $this->string()->notNull(),
            'language_status_id' => $this->integer()->notNull(),
            'language_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'language_created_by' => $this->integer()->defaultValue(null),
            'language_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'language_updated_by' => $this->integer()->defaultValue(null),
            'language_deleted_at' => $this->timestamp()->defaultValue(null),
            'language_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-unique-language_profile_id-language_name}}',
            '{{%language}}',
            ['language_profile_id', 'language_name'],
            true // Hii inaweka unique index
        );

        $this->createIndex(
            '{{%idx-language-language_profile_id}}',
            '{{%language}}',
            'language_profile_id'
        );

        $this->addForeignKey(
            '{{%fk-language-language_profile_id}}',
            '{{%language}}',
            'language_profile_id',
            '{{%profile}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-language-language_status_id}}',
            '{{%language}}',
            'language_status_id'
        );

        $this->addForeignKey(
            '{{%fk-language-language_status_id}}',
            '{{%language}}',
            'language_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-language-language_created_by}}',
            '{{%language}}',
            'language_created_by'
        );

        $this->addForeignKey(
            '{{%fk-language-language_created_by}}',
            '{{%language}}',
            'language_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-language-language_updated_by}}',
            '{{%language}}',
            'language_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-language-language_updated_by}}',
            '{{%language}}',
            'language_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-language-language_deleted_by}}',
            '{{%language}}',
            'language_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-language-language_deleted_by}}',
            '{{%language}}',
            'language_deleted_by',
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
            '{{%fk-language-language_deleted_by}}',
            '{{%language}}'
        );

        $this->dropIndex(
            '{{%idx-language-language_deleted_by}}',
            '{{%language}}'
        );

        $this->dropForeignKey(
            '{{%fk-language-language_updated_by}}',
            '{{%language}}'
        );

        $this->dropIndex(
            '{{%idx-language-language_updated_by}}',
            '{{%language}}'
        );

        $this->dropForeignKey(
            '{{%fk-language-language_created_by}}',
            '{{%language}}'
        );

        $this->dropIndex(
            '{{%idx-language-language_created_by}}',
            '{{%language}}'
        );

        $this->dropForeignKey(
            '{{%fk-language-language_status_id}}',
            '{{%language}}'
        );

        $this->dropIndex(
            '{{%idx-language-language_status_id}}',
            '{{%language}}'
        );

        $this->dropForeignKey(
            '{{%fk-language-language_profile_id}}',
            '{{%language}}'
        );

        $this->dropIndex(
            '{{%idx-language-language_profile_id}}',
            '{{%language}}'
        );

        $this->dropIndex(
            '{{%idx-unique-language_profile_id-language_name}}',
            '{{%language}}'
        );

        $this->dropTable('{{%language}}');
    }
}
