<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%publication}}`.
 */
class m250324_010524_create_publication_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%publication}}', [
            'id' => $this->primaryKey(),
            'publication_profile_id' => $this->integer()->notNull(),
            'publication_title' => $this->string()->notNull(),
            'publication_publisher_name' => $this->string()->notNull(),
            'publication_date_of_publication' => $this->date()->notNull(),
            'publication_status_id' => $this->integer()->notNull(),
            'publication_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'publication_created_by' => $this->integer()->defaultValue(null),
            'publication_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'publication_updated_by' => $this->integer()->defaultValue(null),
            'publication_deleted_at' => $this->timestamp()->defaultValue(null),
            'publication_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-unique-publication_profile_id-title-name-date_of_publication}}',
            '{{%publication}}',
            ['publication_profile_id', 'publication_title', 'publication_publisher_name', 'publication_date_of_publication'],
            true // Hii inaweka unique index
        );

        $this->createIndex(
            '{{%idx-publication-publication_profile_id}}',
            '{{%publication}}',
            'publication_profile_id'
        );

        $this->addForeignKey(
            '{{%fk-publication-publication_profile_id}}',
            '{{%publication}}',
            'publication_profile_id',
            '{{%profile}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-publication-publication_status_id}}',
            '{{%publication}}',
            'publication_status_id'
        );

        $this->addForeignKey(
            '{{%fk-publication-publication_status_id}}',
            '{{%publication}}',
            'publication_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-publication-publication_created_by}}',
            '{{%publication}}',
            'publication_created_by'
        );

        $this->addForeignKey(
            '{{%fk-publication-publication_created_by}}',
            '{{%publication}}',
            'publication_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-publication-publication_updated_by}}',
            '{{%publication}}',
            'publication_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-publication-publication_updated_by}}',
            '{{%publication}}',
            'publication_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-publication-publication_deleted_by}}',
            '{{%publication}}',
            'publication_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-publication-publication_deleted_by}}',
            '{{%publication}}',
            'publication_deleted_by',
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
            '{{%fk-publication-publication_deleted_by}}',
            '{{%publication}}'
        );

        $this->dropIndex(
            '{{%idx-publication-publication_deleted_by}}',
            '{{%publication}}'
        );

        $this->dropForeignKey(
            '{{%fk-publication-publication_updated_by}}',
            '{{%publication}}'
        );

        $this->dropIndex(
            '{{%idx-publication-publication_updated_by}}',
            '{{%publication}}'
        );

        $this->dropForeignKey(
            '{{%fk-publication-publication_created_by}}',
            '{{%publication}}'
        );

        $this->dropIndex(
            '{{%idx-publication-publication_created_by}}',
            '{{%publication}}'
        );

        $this->dropForeignKey(
            '{{%fk-publication-publication_status_id}}',
            '{{%publication}}'
        );

        $this->dropIndex(
            '{{%idx-publication-publication_status_id}}',
            '{{%publication}}'
        );

        $this->dropForeignKey(
            '{{%fk-publication-publication_profile_id}}',
            '{{%publication}}'
        );

        $this->dropIndex(
            '{{%idx-publication-publication_profile_id}}',
            '{{%publication}}'
        );

        $this->dropIndex(
            '{{%idx-unique-publication_profile_id-title-name-date_of_publication}}',
            '{{%publication}}'
        );

        $this->dropTable('{{%publication}}');
    }
}
