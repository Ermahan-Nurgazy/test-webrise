<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notes_tag".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $frequency
 *
 * @property Notes[] $notes
 * @property NotesTagAssn[] $notesTagAssns
 */
class NotesTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notes_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'frequency' => 'Frequency',
        ];
    }

    /**
     * Gets query for [[Notes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasMany(Notes::class, ['id' => 'notes_id'])->viaTable('notes_tag_assn', ['notes_tag_id' => 'id']);
    }

    /**
     * Gets query for [[NotesTagAssns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotesTagAssns()
    {
        return $this->hasMany(NotesTagAssn::class, ['notes_tag_id' => 'id']);
    }
}
