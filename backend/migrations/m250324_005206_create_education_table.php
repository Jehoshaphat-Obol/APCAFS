<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%education}}`.
 */
class m250324_005206_create_education_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%education}}', [
            'id' => $this->primaryKey(),
            'education_profile_id' => $this->integer()->notNull(),
            'education_degree_name' => $this->string(100)->notNull(),
            'education_programme_name' => $this->string(200)->notNull(),
            'education_university_name' => $this->string()->notNull(),
            'education_graduation_date' => $this->date()->notNull(),
            'education_status_id' => $this->integer()->notNull(),
            'education_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'education_created_by' => $this->integer()->defaultValue(null),
            'education_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'education_updated_by' => $this->integer()->defaultValue(null),
            'education_deleted_at' => $this->timestamp()->defaultValue(null),
            'education_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-unique-education_profile-degree-programme-university}}',
            '{{%education}}',
            ['education_profile_id', 'education_degree_name', 'education_programme_name', 'education_university_name'],
            true // Hii inaweka unique index
        );

        $this->createIndex(
            '{{%idx-education-education_profile_id}}',
            '{{%education}}',
            'education_profile_id'
        );

        $this->addForeignKey(
            '{{%fk-education-education_profile_id}}',
            '{{%education}}',
            'education_profile_id',
            '{{%profile}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-education-education_status_id}}',
            '{{%education}}',
            'education_status_id'
        );

        $this->addForeignKey(
            '{{%fk-education-education_status_id}}',
            '{{%education}}',
            'education_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-education-education_created_by}}',
            '{{%education}}',
            'education_created_by'
        );

        $this->addForeignKey(
            '{{%fk-education-education_created_by}}',
            '{{%education}}',
            'education_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-education-education_updated_by}}',
            '{{%education}}',
            'education_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-education-education_updated_by}}',
            '{{%education}}',
            'education_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-education-education_deleted_by}}',
            '{{%education}}',
            'education_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-education-education_deleted_by}}',
            '{{%education}}',
            'education_deleted_by',
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
            '{{%fk-education-education_deleted_by}}',
            '{{%education}}'
        );

        $this->dropIndex(
            '{{%idx-education-education_deleted_by}}',
            '{{%education}}'
        );

        $this->dropForeignKey(
            '{{%fk-education-education_updated_by}}',
            '{{%education}}'
        );

        $this->dropIndex(
            '{{%idx-education-education_updated_by}}',
            '{{%education}}'
        );

        $this->dropForeignKey(
            '{{%fk-education-education_created_by}}',
            '{{%education}}'
        );

        $this->dropIndex(
            '{{%idx-education-education_created_by}}',
            '{{%education}}'
        );

        $this->dropForeignKey(
            '{{%fk-education-education_status_id}}',
            '{{%education}}'
        );

        $this->dropIndex(
            '{{%idx-education-education_status_id}}',
            '{{%education}}'
        );

        $this->dropForeignKey(
            '{{%fk-education-education_profile_id}}',
            '{{%education}}'
        );

        $this->dropIndex(
            '{{%idx-education-education_profile_id}}',
            '{{%education}}'
        );

        $this->dropIndex(
            '{{%idx-unique-education_profile-degree-programme-university}}',
            '{{%education}}'
        );

        $this->dropTable('{{%education}}');
    }
}
