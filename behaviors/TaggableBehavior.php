<?php

namespace app\behaviors;

use app\models\NotesTag;
use dosamigos\taggable\Taggable;
use yii\base\Event;
use yii\db\ActiveRecord;

class TaggableBehavior extends Taggable
{
    /**
     * @param Event $event
     */
    public function afterSave($event)
    {
        if ($this->tagValues === null) {
            $this->tagValues = $this->owner->{$this->attribute};
        }

        if (!$this->owner->getIsNewRecord()) {
            $this->beforeDelete($event);
        }

        $names = array_unique(preg_split(
            '/\s*,\s*/u',
            preg_replace(
                '/\s+/u',
                ' ',
                is_array($this->tagValues)
                    ? implode(',', $this->tagValues)
                    : $this->tagValues
            ),
            -1,
            PREG_SPLIT_NO_EMPTY
        ));

        if(count($names) > 5) {
            $names = array_slice($names, 0, 4);
        }

        $relation = $this->owner->getRelation($this->relation);
        $pivot = $relation->via->from[0];
        /** @var ActiveRecord $class */
        $class = $relation->modelClass;
        $rows = [];
        $updatedTags = [];

        foreach ($names as $name) {
            if(mb_strlen($name) < 3 || mb_strlen($name) > 20) {
                continue;
            }

            $ucf = function ($str, $enc = 'utf-8') {
                return mb_strtoupper(mb_substr($str, 0, 1, $enc), $enc).mb_substr($str, 1, mb_strlen($str, $enc), $enc);
            };

            $name = mb_strtolower($name);
            $name = $ucf($name);

            $tag = $class::findOne([$this->name => $name]);

            if ($tag === null) {
                $tag = new $class();
                $tag->{$this->name} = $name;
            }

            $tag->{$this->frequency}++;

            if ($tag->save()) {
                $updatedTags[] = $tag;
                $rows[] = [$this->owner->getPrimaryKey(), $tag->getPrimaryKey()];
            }
        }

        if (!empty($rows)) {
            $this->owner->getDb()
                ->createCommand()
                ->batchInsert($pivot, [key($relation->via->link), current($relation->link)], $rows)
                ->execute();
        }

        $freeTags = NotesTag::deleteAll(['frequency' => 0]);

        $this->owner->populateRelation($this->relation, $updatedTags);
    }
}
