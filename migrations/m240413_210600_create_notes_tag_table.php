<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notes_tag}}`.
 */
class m240413_210600_create_notes_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notes_tag}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'frequency' => $this->integer()
        ]);

        $this->createIndex('idx_tag_name', '{{%notes_tag}}', 'name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%notes_tag}}');
    }
}
