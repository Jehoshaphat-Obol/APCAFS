<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%district}}`.
 */
class m250323_232746_create_district_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%district}}', [
            'id' => $this->primaryKey(),
            'district_region_id' => $this->integer()->notNull(),
            'district_name' => $this->string()->notNull(),
            'district_status_id' => $this->integer()->notNull(),
            'district_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'district_created_by' => $this->integer()->defaultValue(null),
            'district_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'district_updated_by' => $this->integer()->defaultValue(null),
            'district_deleted_at' => $this->timestamp()->defaultValue(null),
            'district_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-unique-district_region_id-district_name}}',
            '{{%district}}',
            ['district_region_id', 'district_name'],
            true // Hii inaweka unique index
        );

        $this->createIndex(
            '{{%idx-district-district_region_id}}',
            '{{%district}}',
            'district_region_id'
        );

        $this->addForeignKey(
            '{{%fk-district-district_region_id}}',
            '{{%district}}',
            'district_region_id',
            '{{%region}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-district-district_status_id}}',
            '{{%district}}',
            'district_status_id'
        );

        $this->addForeignKey(
            '{{%fk-district-district_status_id}}',
            '{{%district}}',
            'district_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-district-district_created_by}}',
            '{{%district}}',
            'district_created_by'
        );

        $this->addForeignKey(
            '{{%fk-district-district_created_by}}',
            '{{%district}}',
            'district_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-district-district_updated_by}}',
            '{{%district}}',
            'district_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-district-district_updated_by}}',
            '{{%district}}',
            'district_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-district-district_deleted_by}}',
            '{{%district}}',
            'district_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-district-district_deleted_by}}',
            '{{%district}}',
            'district_deleted_by',
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
            '{{%fk-district-district_deleted_by}}',
            '{{%district}}'
        );

        $this->dropIndex(
            '{{%idx-district-district_deleted_by}}',
            '{{%district}}'
        );

        $this->dropForeignKey(
            '{{%fk-district-district_updated_by}}',
            '{{%district}}'
        );

        $this->dropIndex(
            '{{%idx-district-district_updated_by}}',
            '{{%district}}'
        );

        $this->dropForeignKey(
            '{{%fk-district-district_created_by}}',
            '{{%district}}'
        );

        $this->dropIndex(
            '{{%idx-district-district_created_by}}',
            '{{%district}}'
        );

        $this->dropForeignKey(
            '{{%fk-district-district_status_id}}',
            '{{%district}}'
        );

        $this->dropIndex(
            '{{%idx-district-district_status_id}}',
            '{{%district}}'
        );

        $this->dropForeignKey(
            '{{%fk-district-district_region_id}}',
            '{{%district}}'
        );

        $this->dropIndex(
            '{{%idx-district-district_region_id}}',
            '{{%district}}'
        );

        $this->dropIndex(
            '{{%idx-unique-district_region_id-district_name}}',
            '{{%district}}'
        );

        $this->dropTable('{{%district}}');
    }
}
