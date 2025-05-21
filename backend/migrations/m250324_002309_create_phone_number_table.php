<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%phone_number}}`.
 */
class m250324_002309_create_phone_number_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%phone_number}}', [
            'id' => $this->primaryKey(),
            'phone_profile_id' => $this->integer()->notNull(),
            'phone_number' => $this->string(10)->notNull(),
            'phone_status_id' => $this->integer()->notNull(),
            'phone_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'phone_created_by' => $this->integer()->defaultValue(null),
            'phone_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'phone_updated_by' => $this->integer()->defaultValue(null),
            'phone_deleted_at' => $this->timestamp()->defaultValue(null),
            'phone_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-unique-phone_profile_id-phone_number}}',
            '{{%phone_number}}',
            ['phone_profile_id', 'phone_number'],
            true // Hii inaweka unique index
        );

        $this->createIndex(
            '{{%idx-phone_number-phone_profile_id}}',
            '{{%phone_number}}',
            'phone_profile_id'
        );

        $this->addForeignKey(
            '{{%fk-phone_number-phone_profile_id}}',
            '{{%phone_number}}',
            'phone_profile_id',
            '{{%profile}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-phone_number-phone_status_id}}',
            '{{%phone_number}}',
            'phone_status_id'
        );

        $this->addForeignKey(
            '{{%fk-phone_number-phone_status_id}}',
            '{{%phone_number}}',
            'phone_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-phone_number-phone_created_by}}',
            '{{%phone_number}}',
            'phone_created_by'
        );

        $this->addForeignKey(
            '{{%fk-phone_number-phone_created_by}}',
            '{{%phone_number}}',
            'phone_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-phone_number-phone_updated_by}}',
            '{{%phone_number}}',
            'phone_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-phone_number-phone_updated_by}}',
            '{{%phone_number}}',
            'phone_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-phone_number-phone_deleted_by}}',
            '{{%phone_number}}',
            'phone_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-phone_number-phone_deleted_by}}',
            '{{%phone_number}}',
            'phone_deleted_by',
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
            '{{%fk-phone_number-phone_deleted_by}}',
            '{{%phone_number}}'
        );

        $this->dropIndex(
            '{{%idx-phone_number-phone_deleted_by}}',
            '{{%phone_number}}'
        );

        $this->dropForeignKey(
            '{{%fk-phone_number-phone_updated_by}}',
            '{{%phone_number}}'
        );

        $this->dropIndex(
            '{{%idx-phone_number-phone_updated_by}}',
            '{{%phone_number}}'
        );

        $this->dropForeignKey(
            '{{%fk-phone_number-phone_created_by}}',
            '{{%phone_number}}'
        );

        $this->dropIndex(
            '{{%idx-phone_number-phone_created_by}}',
            '{{%phone_number}}'
        );

        $this->dropForeignKey(
            '{{%fk-phone_number-phone_status_id}}',
            '{{%phone_number}}'
        );

        $this->dropIndex(
            '{{%idx-phone_number-phone_status_id}}',
            '{{%phone_number}}'
        );

        $this->dropForeignKey(
            '{{%fk-phone_number-phone_profile_id}}',
            '{{%phone_number}}'
        );

        $this->dropIndex(
            '{{%idx-phone_number-phone_profile_id}}',
            '{{%phone_number}}'
        );

        $this->dropIndex(
            '{{%idx-unique-phone_profile_id-phone_number}}',
            '{{%phone_number}}'
        );

        $this->dropTable('{{%phone_number}}');
    }
}
