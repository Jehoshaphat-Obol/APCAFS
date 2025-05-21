<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m250321_125721_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->defaultValue(null),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'verification_token' => $this->string()->defaultValue(null),
            'user_status_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'user_created_by' => $this->integer()->defaultValue(null),
            'updated_at' => $this->integer()->notNull(),
            'user_updated_by' => $this->integer()->defaultValue(null),
            'user_deleted_at' => $this->timestamp()->defaultValue(null),
            'user_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-user-company_id}}',
            '{{%user}}',
            'company_id'
        );

        $this->addForeignKey(
            '{{%fk-user-company_id}}',
            '{{%user}}',
            'company_id',
            '{{%company}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-user-user_status_id}}',
            '{{%user}}',
            'user_status_id'
        );

        $this->addForeignKey(
            '{{%fk-user-user_status_id}}',
            '{{%user}}',
            'user_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-user-user_deleted_by}}',
            '{{%user}}',
            'user_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-user-user_deleted_by}}',
            '{{%user}}',
            'user_deleted_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-user-user_created_by}}',
            '{{%user}}',
            'user_created_by'
        );

        $this->addForeignKey(
            '{{%fk-user-user_created_by}}',
            '{{%user}}',
            'user_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-user-user_updated_by}}',
            '{{%user}}',
            'user_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-user-user_updated_by}}',
            '{{%user}}',
            'user_updated_by',
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
            '{{%fk-user-user_updated_by}}',
            '{{%user}}'
        );

        $this->dropIndex(
            '{{%idx-user-user_updated_by}}',
            '{{%user}}'
        );

        $this->dropForeignKey(
            '{{%fk-user-user_created_by}}',
            '{{%user}}'
        );

        $this->dropIndex(
            '{{%idx-user-user_created_by}}',
            '{{%user}}'
        );

        $this->dropForeignKey(
            '{{%fk-user-user_deleted_by}}',
            '{{%user}}'
        );

        $this->dropIndex(
            '{{%idx-user-user_deleted_by}}',
            '{{%user}}'
        );

        $this->dropForeignKey(
            '{{%fk-user-user_status_id}}',
            '{{%user}}'
        );

        $this->dropIndex(
            '{{%idx-user-user_status_id}}',
            '{{%user}}'
        );

        $this->dropForeignKey(
            '{{%fk-user-company_id}}',
            '{{%user}}'
        );

        $this->dropIndex(
            '{{%idx-user-company_id}}',
            '{{%user}}'
        );

        $this->dropTable('{{%user}}');
    }
}
