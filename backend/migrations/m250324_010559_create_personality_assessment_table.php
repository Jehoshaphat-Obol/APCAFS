<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%personality_assessment}}`.
 */
class m250324_010559_create_personality_assessment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%personality_assessment}}', [
            'id' => $this->primaryKey(),
            'personality_profile_id' => $this->integer()->notNull(),
            'personality_IE_score' => $this->integer()->notNull(),
            'personality_NS_score' => $this->integer()->notNull(),
            'personality_TF_score' => $this->integer()->notNull(),
            'personality_JB_score' => $this->integer()->notNull(),
            'personality_last_analysis_date' => $this->date()->notNull(),
            'personality_status_id' => $this->integer()->notNull(),
            'personality_created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'personality_created_by' => $this->integer()->defaultValue(null),
            'personality_updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'personality_updated_by' => $this->integer()->defaultValue(null),
            'personality_deleted_at' => $this->timestamp()->defaultValue(null),
            'personality_deleted_by' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            '{{%idx-personality_assessment-personality_profile_id}}',
            '{{%personality_assessment}}',
            'personality_profile_id'
        );

        $this->addForeignKey(
            '{{%fk-personality_assessment-personality_profile_id}}',
            '{{%personality_assessment}}',
            'personality_profile_id',
            '{{%profile}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-personality_assessment-personality_status_id}}',
            '{{%personality_assessment}}',
            'personality_status_id'
        );

        $this->addForeignKey(
            '{{%fk-personality_assessment-personality_status_id}}',
            '{{%personality_assessment}}',
            'personality_status_id',
            '{{%status_lookup}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-personality_assessment-personality_created_by}}',
            '{{%personality_assessment}}',
            'personality_created_by'
        );

        $this->addForeignKey(
            '{{%fk-personality_assessment-personality_created_by}}',
            '{{%personality_assessment}}',
            'personality_created_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-personality_assessment-personality_updated_by}}',
            '{{%personality_assessment}}',
            'personality_updated_by'
        );

        $this->addForeignKey(
            '{{%fk-personality_assessment-personality_updated_by}}',
            '{{%personality_assessment}}',
            'personality_updated_by',
            '{{%user}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        $this->createIndex(
            '{{%idx-personality_assessment-personality_deleted_by}}',
            '{{%personality_assessment}}',
            'personality_deleted_by'
        );

        $this->addForeignKey(
            '{{%fk-personality_assessment-personality_deleted_by}}',
            '{{%personality_assessment}}',
            'personality_deleted_by',
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
            '{{%fk-personality_assessment-personality_deleted_by}}',
            '{{%personality_assessment}}'
        );

        $this->dropIndex(
            '{{%idx-personality_assessment-personality_deleted_by}}',
            '{{%personality_assessment}}'
        );

        $this->dropForeignKey(
            '{{%fk-personality_assessment-personality_updated_by}}',
            '{{%personality_assessment}}'
        );

        $this->dropIndex(
            '{{%idx-personality_assessment-personality_updated_by}}',
            '{{%personality_assessment}}'
        );

        $this->dropForeignKey(
            '{{%fk-personality_assessment-personality_created_by}}',
            '{{%personality_assessment}}'
        );

        $this->dropIndex(
            '{{%idx-personality_assessment-personality_created_by}}',
            '{{%personality_assessment}}'
        );

        $this->dropForeignKey(
            '{{%fk-personality_assessment-personality_status_id}}',
            '{{%personality_assessment}}'
        );

        $this->dropIndex(
            '{{%idx-personality_assessment-personality_status_id}}',
            '{{%personality_assessment}}'
        );

        $this->dropForeignKey(
            '{{%fk-personality_assessment-personality_profile_id}}',
            '{{%personality_assessment}}'
        );

        $this->dropIndex(
            '{{%idx-personality_assessment-personality_profile_id}}',
            '{{%personality_assessment}}'
        );

        $this->dropTable('{{%personality_assessment}}');
    }
}
