<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%job_application}}`.
 */
class m250324_123918_create_job_application_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%job_application}}', [
            'id' => $this->primaryKey(),
            'applicant_company_id' => $this->integer()->notNull(),
            'applicant_job_post_id' => $this->integer()->notNull(),
            'applicant_user_id' => $this->integer()->notNull(), // hii ni id ya applicant
            'applicant_score' => $this->decimal(3,2)->null(),
            'applicant_status_id' => $this->integer()->notNull(),
            'applicant_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'applicant_created_by' => $this->integer()->defaultValue(null),
            'applicant_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'applicant_updated_by' => $this->integer()->defaultValue(null),
            'applicant_deleted_at' => $this->timestamp()->defaultValue(null),
            'applicant_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-job_application-applicant_company_id}}',
            '{{%job_application}}',
            'applicant_company_id'
        );

        $this->addForeignKey(
            '{{%fk-job_application-applicant_company_id}}',
            '{{%job_application}}',
            'applicant_company_id',
            '{{%company}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-job_application-applicant_job_post_id}}',
            '{{%job_application}}',
            'applicant_job_post_id'
        );

        $this->addForeignKey(
            '{{%fk-job_application-applicant_job_post_id}}',
            '{{%job_application}}',
            'applicant_job_post_id',
            '{{%job_post}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-job_application-applicant_user_id}}',
            '{{%job_application}}',
            'applicant_user_id'
        );

        $this->addForeignKey(
            '{{%fk-job_application-applicant_user_id}}',
            '{{%job_application}}',
            'applicant_user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-job_application-applicant_status_id}}',
            '{{%job_application}}',
            'applicant_status_id'
        );

        $this->addForeignKey(
            '{{%fk-job_application-applicant_status_id}}',
            '{{%job_application}}',
            'applicant_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-job_application-applicant_created_by}}',
            '{{%job_application}}',
            'applicant_created_by'
        );

        $this->addForeignKey(
            '{{%fk-job_application-applicant_created_by}}',
            '{{%job_application}}',
            'applicant_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-job_application-applicant_updated_by}}',
            '{{%job_application}}',
            'applicant_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-job_application-applicant_updated_by}}',
            '{{%job_application}}',
            'applicant_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-job_application-applicant_deleted_by}}',
            '{{%job_application}}',
            'applicant_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-job_application-applicant_deleted_by}}',
            '{{%job_application}}',
            'applicant_deleted_by',
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
            '{{%fk-job_application-applicant_deleted_by}}',
            '{{%job_application}}'
        );

        $this->dropIndex(
            '{{%idx-job_application-applicant_deleted_by}}',
            '{{%job_application}}'
        );

        $this->dropForeignKey(
            '{{%fk-job_application-applicant_updated_by}}',
            '{{%job_application}}'
        );

        $this->dropIndex(
            '{{%idx-job_application-applicant_updated_by}}',
            '{{%job_application}}'
        );

        $this->dropForeignKey(
            '{{%fk-job_application-applicant_created_by}}',
            '{{%job_application}}'
        );

        $this->dropIndex(
            '{{%idx-job_application-applicant_created_by}}',
            '{{%job_application}}'
        );

        $this->dropForeignKey(
            '{{%fk-job_application-applicant_status_id}}',
            '{{%job_application}}'
        );

        $this->dropIndex(
            '{{%idx-job_application-applicant_status_id}}',
            '{{%job_application}}'
        );

        $this->dropForeignKey(
            '{{%fk-job_application-applicant_user_id}}',
            '{{%job_application}}'
        );

        $this->dropIndex(
            '{{%idx-job_application-applicant_user_id}}',
            '{{%job_application}}'
        );

        $this->dropForeignKey(
            '{{%fk-job_application-applicant_job_post_id}}',
            '{{%job_application}}'
        );

        $this->dropIndex(
            '{{%idx-job_application-applicant_job_post_id}}',
            '{{%job_application}}'
        );
        
        $this->dropForeignKey(
            '{{%fk-job_application-applicant_company_id}}',
            '{{%job_application}}'
        );

        $this->dropIndex(
            '{{%idx-job_application-applicant_company_id}}',
            '{{%job_application}}'
        );

        $this->dropTable('{{%job_application}}');
    }
}
