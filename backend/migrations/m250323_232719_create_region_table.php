<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%region}}`.
 */
class m250323_232719_create_region_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%region}}', [
            'id' => $this->primaryKey(),
            'region_name' => $this->string()->notNull()->unique(),
            'region_status_id' => $this->integer()->notNull(),
            'region_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'region_created_by' => $this->integer()->defaultValue(null),
            'region_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'region_updated_by' => $this->integer()->defaultValue(null),
            'region_deleted_at' => $this->timestamp()->defaultValue(null),
            'region_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-region-region_status_id}}',
            '{{%region}}',
            'region_status_id'
        );

        $this->addForeignKey(
            '{{%fk-region-region_status_id}}',
            '{{%region}}',
            'region_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-region-region_created_by}}',
            '{{%region}}',
            'region_created_by'
        );

        $this->addForeignKey(
            '{{%fk-region-region_created_by}}',
            '{{%region}}',
            'region_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-region-region_updated_by}}',
            '{{%region}}',
            'region_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-region-region_updated_by}}',
            '{{%region}}',
            'region_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-region-region_deleted_by}}',
            '{{%region}}',
            'region_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-region-region_deleted_by}}',
            '{{%region}}',
            'region_deleted_by',
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
            '{{%fk-region-region_deleted_by}}',
            '{{%region}}'
        );

        $this->dropIndex(
            '{{%idx-region-region_deleted_by}}',
            '{{%region}}'
        );

        $this->dropForeignKey(
            '{{%fk-region-region_updated_by}}',
            '{{%region}}'
        );

        $this->dropIndex(
            '{{%idx-region-region_updated_by}}',
            '{{%region}}'
        );

        $this->dropForeignKey(
            '{{%fk-region-region_created_by}}',
            '{{%region}}'
        );

        $this->dropIndex(
            '{{%idx-region-region_created_by}}',
            '{{%region}}'
        );

        $this->dropForeignKey(
            '{{%fk-region-region_status_id}}',
            '{{%region}}'
        );

        $this->dropIndex(
            '{{%idx-region-region_status_id}}',
            '{{%region}}'
        );

        $this->dropTable('{{%region}}');
    }
}
