<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work_experience}}`.
 */
class m250324_003712_create_work_experience_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work_experience}}', [
            'id' => $this->primaryKey(),
            'experience_profile_id' => $this->integer()->notNull(),
            'experience_job_title' => $this->string(100)->defaultValue(null),
            'experience_company_name' => $this->string(150)->notNull(),
            'experience_from' => $this->date()->notNull(),
            'experience_to' => $this->date()->defaultValue(null),
            'experience_status_id' => $this->integer()->notNull(),
            'experience_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'experience_created_by' => $this->integer()->defaultValue(null),
            'experience_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'experience_updated_by' => $this->integer()->defaultValue(null),
            'experience_deleted_at' => $this->timestamp()->defaultValue(null),
            'experience_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-unique-experience_profile-job_title-company_name-from-to}}',
            '{{%work_experience}}',
            ['experience_profile_id', 'experience_job_title', 'experience_company_name', 'experience_from', 'experience_to'],
            true // Hii inaweka unique index
        );

        $this->createIndex(
            '{{%idx-work_experience-experience_profile_id}}',
            '{{%work_experience}}',
            'experience_profile_id'
        );

        $this->addForeignKey(
            '{{%fk-work_experience-experience_profile_id}}',
            '{{%work_experience}}',
            'experience_profile_id',
            '{{%profile}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-work_experience-experience_status_id}}',
            '{{%work_experience}}',
            'experience_status_id'
        );

        $this->addForeignKey(
            '{{%fk-work_experience-experience_status_id}}',
            '{{%work_experience}}',
            'experience_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-work_experience-experience_created_by}}',
            '{{%work_experience}}',
            'experience_created_by'
        );

        $this->addForeignKey(
            '{{%fk-work_experience-experience_created_by}}',
            '{{%work_experience}}',
            'experience_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-work_experience-experience_updated_by}}',
            '{{%work_experience}}',
            'experience_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-work_experience-experience_updated_by}}',
            '{{%work_experience}}',
            'experience_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-work_experience-experience_deleted_by}}',
            '{{%work_experience}}',
            'experience_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-work_experience-experience_deleted_by}}',
            '{{%work_experience}}',
            'experience_deleted_by',
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
            '{{%fk-work_experience-experience_deleted_by}}',
            '{{%work_experience}}'
        );

        $this->dropIndex(
            '{{%idx-work_experience-experience_deleted_by}}',
            '{{%work_experience}}'
        );

        $this->dropForeignKey(
            '{{%fk-work_experience-experience_updated_by}}',
            '{{%work_experience}}'
        );

        $this->dropIndex(
            '{{%idx-work_experience-experience_updated_by}}',
            '{{%work_experience}}'
        );

        $this->dropForeignKey(
            '{{%fk-work_experience-experience_created_by}}',
            '{{%work_experience}}'
        );

        $this->dropIndex(
            '{{%idx-work_experience-experience_created_by}}',
            '{{%work_experience}}'
        );

        $this->dropForeignKey(
            '{{%fk-work_experience-experience_status_id}}',
            '{{%work_experience}}'
        );

        $this->dropIndex(
            '{{%idx-work_experience-experience_status_id}}',
            '{{%work_experience}}'
        );

        $this->dropForeignKey(
            '{{%fk-work_experience-experience_profile_id}}',
            '{{%work_experience}}'
        );

        $this->dropIndex(
            '{{%idx-work_experience-experience_profile_id}}',
            '{{%work_experience}}'
        );

        $this->dropIndex(
            '{{%idx-unique-experience_profile-job_title-company_name-from-to}}',
            '{{%work_experience}}'
        );

        $this->dropTable('{{%work_experience}}');
    }
}
