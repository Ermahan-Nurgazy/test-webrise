<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notes_tag_assn".
 *
 * @property int $notes_id
 * @property int $notes_tag_id
 *
 * @property Notes $notes
 * @property NotesTag $notesTag
 */
class NotesTagAssn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notes_tag_assn';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['notes_id', 'notes_tag_id'], 'required'],
            [['notes_id', 'notes_tag_id'], 'integer'],
            [['notes_id', 'notes_tag_id'], 'unique', 'targetAttribute' => ['notes_id', 'notes_tag_id']],
            [['notes_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notes::class, 'targetAttribute' => ['notes_id' => 'id']],
            [['notes_tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => NotesTag::class, 'targetAttribute' => ['notes_tag_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'notes_id' => 'Notes ID',
            'notes_tag_id' => 'Notes Tag ID',
        ];
    }

    /**
     * Gets query for [[Notes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasOne(Notes::class, ['id' => 'notes_id']);
    }

    /**
     * Gets query for [[NotesTag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotesTag()
    {
        return $this->hasOne(NotesTag::class, ['id' => 'notes_tag_id']);
    }
}
