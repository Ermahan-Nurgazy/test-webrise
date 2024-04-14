<?php

namespace app\models;

use app\behaviors\TaggableBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "notes".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 *
 * @property NotesTagAssn[] $notesTagAssns
 * @property NotesTag[] $notesTags
 * @property User $user
 */
class Notes extends \yii\db\ActiveRecord
{
    public $tagNames;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'content'], 'required'],
            [['user_id'], 'integer'],
            [['content'], 'string'],
            [['tagNames'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at','updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            [
                'class' => TaggableBehavior::className(),
                'relation' => 'notesTags'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Заголовок',
            'content' => 'Содержание',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'tagNames' => 'Тэги',
        ];
    }

    /**
     * Gets query for [[NotesTagAssns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotesTagAssns()
    {
        return $this->hasMany(NotesTagAssn::class, ['notes_id' => 'id']);
    }

    /**
     * Gets query for [[NotesTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotesTags()
    {
        return $this->hasMany(NotesTag::class, ['id' => 'notes_tag_id'])->viaTable('notes_tag_assn', ['notes_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
