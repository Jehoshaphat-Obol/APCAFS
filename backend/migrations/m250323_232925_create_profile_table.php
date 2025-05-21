<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profile}}`.
 */
class m250323_232925_create_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%profile}}', [
            'id' => $this->primaryKey(),
            'profile_user_id' => $this->integer()->notNull(),
            'profile_first_name' => $this->string(100)->notNull(),
            'profile_middle_name' => $this->string(100)->null(),
            'profile_last_name' => $this->string(100)->notNull(),
            'profile_social_media_username' => $this->string()->notNull(),
            'profile_date_of_birth' => $this->date()->notNull(),
            'profile_bios' => $this->text()->null(),
            'profile_region_id' => $this->integer()->notNull(),
            'profile_district_id' => $this->integer()->notNull(),
            'profile_local_address' => $this->string()->defaultValue(null),
            'profile_status_id' => $this->integer()->notNull(),
            'profile_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'profile_created_by' => $this->integer()->defaultValue(null),
            'profile_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'profile_updated_by' => $this->integer()->defaultValue(null),
            'profile_deleted_at' => $this->timestamp()->defaultValue(null),
            'profile_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-profile-profile_user_id}}',
            '{{%profile}}',
            'profile_user_id'
        );

        $this->addForeignKey(
            '{{%fk-profile-profile_user_id}}',
            '{{%profile}}',
            'profile_user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-profile-profile_region_id}}',
            '{{%profile}}',
            'profile_region_id'
        );

        $this->addForeignKey(
            '{{%fk-profile-profile_region_id}}',
            '{{%profile}}',
            'profile_region_id',
            '{{%region}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-profile-profile_district_id}}',
            '{{%profile}}',
            'profile_district_id'
        );

        $this->addForeignKey(
            '{{%fk-profile-profile_district_id}}',
            '{{%profile}}',
            'profile_district_id',
            '{{%district}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-profile-profile_status_id}}',
            '{{%profile}}',
            'profile_status_id'
        );

        $this->addForeignKey(
            '{{%fk-profile-profile_status_id}}',
            '{{%profile}}',
            'profile_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-profile-profile_created_by}}',
            '{{%profile}}',
            'profile_created_by'
        );

        $this->addForeignKey(
            '{{%fk-profile-profile_created_by}}',
            '{{%profile}}',
            'profile_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-profile-profile_updated_by}}',
            '{{%profile}}',
            'profile_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-profile-profile_updated_by}}',
            '{{%profile}}',
            'profile_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-profile-profile_deleted_by}}',
            '{{%profile}}',
            'profile_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-profile-profile_deleted_by}}',
            '{{%profile}}',
            'profile_deleted_by',
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
            '{{%fk-profile-profile_deleted_by}}',
            '{{%profile}}'
        );

        $this->dropIndex(
            '{{%idx-profile-profile_deleted_by}}',
            '{{%profile}}'
        );

        $this->dropForeignKey(
            '{{%fk-profile-profile_updated_by}}',
            '{{%profile}}'
        );

        $this->dropIndex(
            '{{%idx-profile-profile_updated_by}}',
            '{{%profile}}'
        );

        $this->dropForeignKey(
            '{{%fk-profile-profile_created_by}}',
            '{{%profile}}'
        );

        $this->dropIndex(
            '{{%idx-profile-profile_created_by}}',
            '{{%profile}}'
        );

        $this->dropForeignKey(
            '{{%fk-profile-profile_status_id}}',
            '{{%profile}}'
        );

        $this->dropIndex(
            '{{%idx-profile-profile_status_id}}',
            '{{%profile}}'
        );

        $this->dropForeignKey(
            '{{%fk-profile-profile_district_id}}',
            '{{%profile}}'
        );

        $this->dropIndex(
            '{{%idx-profile-profile_district_id}}',
            '{{%profile}}'
        );

        $this->dropForeignKey(
            '{{%fk-profile-profile_region_id}}',
            '{{%profile}}'
        );

        $this->dropIndex(
            '{{%idx-profile-profile_region_id}}',
            '{{%profile}}'
        );

        $this->dropForeignKey(
            '{{%fk-profile-profile_user_id}}',
            '{{%profile}}'
        );

        $this->dropIndex(
            '{{%idx-profile-profile_user_id}}',
            '{{%profile}}'
        );

        $this->dropTable('{{%profile}}');
    }
}
