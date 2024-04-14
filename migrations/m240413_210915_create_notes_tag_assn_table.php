<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notes_tag_assn}}`.
 */
class m240413_210915_create_notes_tag_assn_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notes_tag_assn}}', [
            'notes_id' => $this->integer(),
            'notes_tag_id' => $this->integer(),
        ]);

        $this->addPrimaryKey('pk_notes_tag_assn', '{{%notes_tag_assn}}', ['notes_id', 'notes_tag_id']);
        $this->addForeignKey('fk_tagAssn_notes', '{{%notes_tag_assn}}', 'notes_id', 'notes', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk_tagAssn_notes_tag', '{{%notes_tag_assn}}', 'notes_tag_id', 'notes_tag', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%notes_tag_assn}}');
    }
}
