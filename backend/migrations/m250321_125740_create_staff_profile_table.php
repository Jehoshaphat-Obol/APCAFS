<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%staff_profile}}`.
 */
class m250321_125740_create_staff_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%staff_profile}}', [
            'id' => $this->primaryKey(),
            'staff_company_id' => $this->integer()->notNull(),
            'staff_user_id' => $this->integer()->notNull(),
            'staff_first_name' => $this->string(100)->notNull(),
            'staff_middle_name' => $this->string(100),
            'staff_last_name' => $this->string(100)->notNull(),
            'staff_phone_number' => $this->string(10)->notNull(),
            'staff_status_id' => $this->integer()->notNull(),
            'staff_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'staff_created_by' => $this->integer()->defaultValue(null),
            'staff_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'staff_updated_by' => $this->integer()->defaultValue(null),
            'staff_deleted_at' => $this->timestamp()->defaultValue(null),
            'staff_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-unique-staff_company-user-first_name-last_name-phone_number}}',
            '{{%staff_profile}}',
            ['staff_company_id', 'staff_user_id', 'staff_first_name', 'staff_last_name', 'staff_phone_number'],
            true // Hii inaweka unique index
        );

        $this->createIndex(
            '{{%idx-staff_profile-staff_company_id}}',
            '{{%staff_profile}}',
            'staff_company_id'
        );

        $this->addForeignKey(
            '{{%fk-staff_profile-staff_company_id}}',
            '{{%staff_profile}}',
            'staff_company_id',
            '{{%company}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-staff_profile-staff_user_id}}',
            '{{%staff_profile}}',
            'staff_user_id'
        );

        $this->addForeignKey(
            '{{%fk-staff_profile-staff_user_id}}',
            '{{%staff_profile}}',
            'staff_user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-staff_profile-staff_status_id}}',
            '{{%staff_profile}}',
            'staff_status_id'
        );

        $this->addForeignKey(
            '{{%fk-staff_profile-staff_status_id}}',
            '{{%staff_profile}}',
            'staff_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-staff_profile-staff_created_by}}',
            '{{%staff_profile}}',
            'staff_created_by'
        );

        $this->addForeignKey(
            '{{%fk-staff_profile-staff_created_by}}',
            '{{%staff_profile}}',
            'staff_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-staff_profile-staff_updated_by}}',
            '{{%staff_profile}}',
            'staff_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-staff_profile-staff_updated_by}}',
            '{{%staff_profile}}',
            'staff_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-staff_profile-staff_deleted_by}}',
            '{{%staff_profile}}',
            'staff_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-staff_profile-staff_deleted_by}}',
            '{{%staff_profile}}',
            'staff_deleted_by',
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
            '{{%fk-staff_profile-staff_deleted_by}}',
            '{{%staff_profile}}'
        );

        $this->dropIndex(
            '{{%idx-staff_profile-staff_deleted_by}}',
            '{{%staff_profile}}'
        );

        $this->dropForeignKey(
            '{{%fk-staff_profile-staff_updated_by}}',
            '{{%staff_profile}}'
        );

        $this->dropIndex(
            '{{%idx-staff_profile-staff_updated_by}}',
            '{{%staff_profile}}'
        );

        $this->dropForeignKey(
            '{{%fk-staff_profile-staff_created_by}}',
            '{{%staff_profile}}'
        );

        $this->dropIndex(
            '{{%idx-staff_profile-staff_created_by}}',
            '{{%staff_profile}}'
        );

        $this->dropForeignKey(
            '{{%fk-staff_profile-staff_status_id}}',
            '{{%staff_profile}}'
        );

        $this->dropIndex(
            '{{%idx-staff_profile-staff_status_id}}',
            '{{%staff_profile}}'
        );

        $this->dropForeignKey(
            '{{%fk-staff_profile-staff_user_id}}',
            '{{%staff_profile}}'
        );

        $this->dropIndex(
            '{{%idx-staff_profile-staff_user_id}}',
            '{{%staff_profile}}'
        );
        
        $this->dropForeignKey(
            '{{%fk-staff_profile-staff_company_id}}',
            '{{%staff_profile}}'
        );

        $this->dropIndex(
            '{{%idx-staff_profile-staff_company_id}}',
            '{{%staff_profile}}'
        );

        $this->createIndex(
            '{{%idx-unique-staff_company-user-first_name-last_name-phone_number}}',
            '{{%staff_profile}}'
        );

        $this->dropTable('{{%staff_profile}}');
    }
}
