<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%job_post}}`.
 */
class m250324_123641_create_job_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%job_post}}', [
            'id' => $this->primaryKey(),
            'post_company_id' => $this->integer()->notNull(),
            'post_user_id' => $this->integer()->notNull()->defaultValue(null), // hii ni id ya mtengeneza hii post
            'post_job_title' => $this->string(100)->notNull(),
            'post_job_type' => $this->string(30)->notNull(),
            'post_job_description' => $this->text()->notNull(),
            'post_publication_date' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'post_deadline' => $this->date()->notNull(),
            'post_profession' => $this->string()->notNull(),
            'post_location' => $this->string()->notNull(),
            'post_is_remote' => $this->tinyInteger()->defaultValue(0), // 0 = false, 1 = true
            'post_salary_range_min' => $this->decimal(10,2)->defaultValue(0.00),
            'post_salary_range_max' => $this->decimal(10,2)->defaultValue(0.00),
            'post_status_id' => $this->integer()->notNull(),
            'post_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'post_created_by' => $this->integer()->defaultValue(null),
            'post_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'post_updated_by' => $this->integer()->defaultValue(null),
            'post_deleted_at' => $this->timestamp()->defaultValue(null),
            'post_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-unique-post_company-user-title-type-profession}}',
            '{{%job_post}}',
            ['post_company_id', 'post_user_id', 'post_job_title', 'post_job_type', 'post_profession', 'post_publication_date', 'post_deadline'],
            true // Hii inaweka unique index
        );

        $this->createIndex(
            '{{%idx-job_post-post_company_id}}',
            '{{%job_post}}',
            'post_company_id'
        );

        $this->addForeignKey(
            '{{%fk-job_post-post_company_id}}',
            '{{%job_post}}',
            'post_company_id',
            '{{%company}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-job_post-post_user_id}}',
            '{{%job_post}}',
            'post_user_id'
        );

        $this->addForeignKey(
            '{{%fk-job_post-post_user_id}}',
            '{{%job_post}}',
            'post_user_id',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-job_post-post_status_id}}',
            '{{%job_post}}',
            'post_status_id'
        );

        $this->addForeignKey(
            '{{%fk-job_post-post_status_id}}',
            '{{%job_post}}',
            'post_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-job_post-post_created_by}}',
            '{{%job_post}}',
            'post_created_by'
        );

        $this->addForeignKey(
            '{{%fk-job_post-post_created_by}}',
            '{{%job_post}}',
            'post_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-job_post-post_updated_by}}',
            '{{%job_post}}',
            'post_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-job_post-post_updated_by}}',
            '{{%job_post}}',
            'post_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-job_post-post_deleted_by}}',
            '{{%job_post}}',
            'post_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-job_post-post_deleted_by}}',
            '{{%job_post}}',
            'post_deleted_by',
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
            '{{%fk-job_post-post_deleted_by}}',
            '{{%job_post}}'
        );

        $this->dropIndex(
            '{{%idx-job_post-post_deleted_by}}',
            '{{%job_post}}'
        );

        $this->dropForeignKey(
            '{{%fk-job_post-post_updated_by}}',
            '{{%job_post}}'
        );

        $this->dropIndex(
            '{{%idx-job_post-post_updated_by}}',
            '{{%job_post}}'
        );

        $this->dropForeignKey(
            '{{%fk-job_post-post_created_by}}',
            '{{%job_post}}'
        );

        $this->dropIndex(
            '{{%idx-job_post-post_created_by}}',
            '{{%job_post}}'
        );

        $this->dropForeignKey(
            '{{%fk-job_post-post_status_id}}',
            '{{%job_post}}'
        );

        $this->dropIndex(
            '{{%idx-job_post-post_status_id}}',
            '{{%job_post}}'
        );

        $this->dropForeignKey(
            '{{%fk-job_post-post_user_id}}',
            '{{%job_post}}'
        );

        $this->dropIndex(
            '{{%idx-job_post-post_user_id}}',
            '{{%job_post}}'
        );
        
        $this->dropForeignKey(
            '{{%fk-job_post-post_company_id}}',
            '{{%job_post}}'
        );

        $this->dropIndex(
            '{{%idx-job_post-post_company_id}}',
            '{{%job_post}}'
        );

        $this->dropIndex(
            '{{%idx-unique-post_company-user-title-type-profession}}',
            '{{%job_post}}'
        );

        $this->dropTable('{{%job_post}}');
    }
}
