<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%award}}`.
 */
class m250324_010436_create_award_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%award}}', [
            'id' => $this->primaryKey(),
            'award_profile_id' => $this->integer()->notNull(),
            'award_title' => $this->string()->notNull(),
            'award_organization_name' => $this->string(200)->notNull(),
            'award_issue_number' => $this->string(50)->notNull(),
            'award_date_of_issue' => $this->date()->notNull(),
            'award_status_id' => $this->integer()->notNull(),
            'award_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'award_created_by' => $this->integer()->defaultValue(null),
            'award_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'award_updated_by' => $this->integer()->defaultValue(null),
            'award_deleted_at' => $this->timestamp()->defaultValue(null),
            'award_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-unique-award_profile_id-award_title-award_organization_name}}',
            '{{%award}}',
            ['award_profile_id', 'award_title', 'award_organization_name', 'award_issue_number'],
            true // Hii inaweka unique index
        );

        $this->createIndex(
            '{{%idx-award-award_profile_id}}',
            '{{%award}}',
            'award_profile_id'
        );

        $this->addForeignKey(
            '{{%fk-award-award_profile_id}}',
            '{{%award}}',
            'award_profile_id',
            '{{%profile}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-award-award_status_id}}',
            '{{%award}}',
            'award_status_id'
        );

        $this->addForeignKey(
            '{{%fk-award-award_status_id}}',
            '{{%award}}',
            'award_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-award-award_created_by}}',
            '{{%award}}',
            'award_created_by'
        );

        $this->addForeignKey(
            '{{%fk-award-award_created_by}}',
            '{{%award}}',
            'award_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-award-award_updated_by}}',
            '{{%award}}',
            'award_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-award-award_updated_by}}',
            '{{%award}}',
            'award_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-award-award_deleted_by}}',
            '{{%award}}',
            'award_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-award-award_deleted_by}}',
            '{{%award}}',
            'award_deleted_by',
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
            '{{%fk-award-award_deleted_by}}',
            '{{%award}}'
        );

        $this->dropIndex(
            '{{%idx-award-award_deleted_by}}',
            '{{%award}}'
        );

        $this->dropForeignKey(
            '{{%fk-award-award_updated_by}}',
            '{{%award}}'
        );

        $this->dropIndex(
            '{{%idx-award-award_updated_by}}',
            '{{%award}}'
        );

        $this->dropForeignKey(
            '{{%fk-award-award_created_by}}',
            '{{%award}}'
        );

        $this->dropIndex(
            '{{%idx-award-award_created_by}}',
            '{{%award}}'
        );

        $this->dropForeignKey(
            '{{%fk-award-award_status_id}}',
            '{{%award}}'
        );

        $this->dropIndex(
            '{{%idx-award-award_status_id}}',
            '{{%award}}'
        );

        $this->dropForeignKey(
            '{{%fk-award-award_profile_id}}',
            '{{%award}}'
        );

        $this->dropIndex(
            '{{%idx-award-award_profile_id}}',
            '{{%award}}'
        );

        $this->dropIndex(
            '{{%idx-unique-award_profile_id-award_title-award_organization_name}}',
            '{{%award}}'
        );

        $this->dropTable('{{%award}}');
    }
}
