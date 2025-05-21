<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%skill}}`.
 */
class m250324_010422_create_skill_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%skill}}', [
            'id' => $this->primaryKey(),
            'skill_profile_id' => $this->integer()->notNull(),
            'skill_type' => $this->string(100)->notNull(),
            'skill_name' => $this->string(200)->notNull(),
            'skill_status_id' => $this->integer()->notNull(),
            'skill_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'skill_created_by' => $this->integer()->defaultValue(null),
            'skill_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'skill_updated_by' => $this->integer()->defaultValue(null),
            'skill_deleted_at' => $this->timestamp()->defaultValue(null),
            'skill_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-unique-skill_profile_id-skill_type-skill_name}}',
            '{{%skill}}',
            ['skill_profile_id', 'skill_type', 'skill_name'],
            true // Hii inaweka unique index
        );

        $this->createIndex(
            '{{%idx-skill-skill_profile_id}}',
            '{{%skill}}',
            'skill_profile_id'
        );

        $this->addForeignKey(
            '{{%fk-skill-skill_profile_id}}',
            '{{%skill}}',
            'skill_profile_id',
            '{{%profile}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-skill-skill_status_id}}',
            '{{%skill}}',
            'skill_status_id'
        );

        $this->addForeignKey(
            '{{%fk-skill-skill_status_id}}',
            '{{%skill}}',
            'skill_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-skill-skill_created_by}}',
            '{{%skill}}',
            'skill_created_by'
        );

        $this->addForeignKey(
            '{{%fk-skill-skill_created_by}}',
            '{{%skill}}',
            'skill_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-skill-skill_updated_by}}',
            '{{%skill}}',
            'skill_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-skill-skill_updated_by}}',
            '{{%skill}}',
            'skill_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-skill-skill_deleted_by}}',
            '{{%skill}}',
            'skill_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-skill-skill_deleted_by}}',
            '{{%skill}}',
            'skill_deleted_by',
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
            '{{%fk-skill-skill_deleted_by}}',
            '{{%skill}}'
        );

        $this->dropIndex(
            '{{%idx-skill-skill_deleted_by}}',
            '{{%skill}}'
        );

        $this->dropForeignKey(
            '{{%fk-skill-skill_updated_by}}',
            '{{%skill}}'
        );

        $this->dropIndex(
            '{{%idx-skill-skill_updated_by}}',
            '{{%skill}}'
        );

        $this->dropForeignKey(
            '{{%fk-skill-skill_created_by}}',
            '{{%skill}}'
        );

        $this->dropIndex(
            '{{%idx-skill-skill_created_by}}',
            '{{%skill}}'
        );

        $this->dropForeignKey(
            '{{%fk-skill-skill_status_id}}',
            '{{%skill}}'
        );

        $this->dropIndex(
            '{{%idx-skill-skill_status_id}}',
            '{{%skill}}'
        );

        $this->dropForeignKey(
            '{{%fk-skill-skill_profile_id}}',
            '{{%skill}}'
        );

        $this->dropIndex(
            '{{%idx-skill-skill_profile_id}}',
            '{{%skill}}'
        );

        $this->dropIndex(
            '{{%idx-unique-skill_profile_id-skill_type-skill_name}}',
            '{{%skill}}'
        );

        $this->dropTable('{{%skill}}');
    }
}
