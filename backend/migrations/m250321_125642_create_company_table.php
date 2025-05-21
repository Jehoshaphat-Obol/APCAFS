<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company}}`.
 */
class m250321_125642_create_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(),
            'company_name' => $this->string()->notNull()->unique(),
            'company_phone_number'=> $this->string(10)->notNull(),
            'company_email' => $this->string()->notNull()->unique(),
            'company_address' => $this->string()->notNull(),
            'company_website_url' => $this->string()->null(),
            'company_user_size' => $this->integer()->notNull()->defaultValue(2), // default company user size is 1
            'company_activation_code' => $this->string(50)->notNull(),
            'company_activation_code_date' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->defaultValue(null),
            'company_status_id' => $this->integer()->notNull(),
            'company_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'company_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'company_deleted_at' => $this->timestamp()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-company-company_status_id}}',
            '{{%company}}',
            'company_status_id'
        );

        $this->addForeignKey(
            '{{%fk-company-company_status_id}}',
            '{{%company}}',
            'company_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-company-company_status_id}}',
            '{{%company}}'
        );

        $this->dropIndex(
            '{{%idx-company-company_status_id}}',
            '{{%company}}'
        );
        
        $this->dropTable('{{%company}}');
    }
}
