<?php

namespace app\models\search;

use yii\base\Model;
use app\models\Notes;

/**
 * NotesSearch represents the model behind the search form of `app\models\Notes`.
 */
class NotesSearch extends Notes
{
    public $time;
    public $searchInput;
    public $sort;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id','sort'], 'integer'],
            [['title', 'content', 'created_at', 'updated_at'], 'safe'],
            [['time','searchInput'],'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return \yii\db\ActiveQuery
     */
    public function search($params)
    {
        $query = Notes::find()->where(['user_id' => \Yii::$app->user->identity->id]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $query;
        }

        if ($this->time == 'month') {
            $startOfMonth = new \DateTime(date('Y-m-01'));
            $endOfMonth = new \DateTime(date('Y-m-t'));
            $query->andFilterWhere(['between', 'updated_at', $startOfMonth->getTimestamp(), $endOfMonth->getTimestamp()]);
        }

        if ($this->time == 'week') {
            $startOfWeek = new \DateTime(date('Y-m-d', strtotime('last monday')));
            $endOfWeek = new \DateTime(date('Y-m-d', strtotime('next sunday')));
            $query->andFilterWhere(['between', 'updated_at', $startOfWeek->getTimestamp(), $endOfWeek->getTimestamp()]);
        }



        if (!empty($this->searchInput)) {
            $query->andWhere(['OR',
                ['LIKE', 'notes.content', $this->searchInput],
                ['LIKE', 'notes.content', '%'. $this->searchInput],
                ['LIKE', 'notes.content', $this->searchInput . '%'],
                ['LIKE', 'notes.content', '%'. $this->searchInput . '%']
            ]);

            $query->leftJoin('notes_tag_assn', 'notes.id = notes_tag_assn.notes_id');

            $query->leftJoin('notes_tag', 'notes_tag.id = notes_tag_assn.notes_tag_id')
                ->orWhere(['LIKE', 'notes_tag.name', $this->searchInput]);
        }

        $query->orderBy(['id' => $this->sort !== null ? (int) $this->sort :  SORT_DESC]);

        return $query;
    }
}
