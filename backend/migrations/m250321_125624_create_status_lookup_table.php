<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%status_lookup}}`.
 */
class m250321_125624_create_status_lookup_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%status_lookup}}', [
            'id' => $this->primaryKey(),
            'status_code' => $this->string(10)->notNull()->unique(),
            'status_name' => $this->string(100)->notNull(),
            'status_description' => $this->text()->null(),
            'status_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'status_updated_at' => $this->timestamp( )->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'status_deleted_at' => $this->timestamp()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%status_lookup}}');
    }
}
