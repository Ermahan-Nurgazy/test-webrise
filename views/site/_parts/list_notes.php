<div class="d-flex justify-content-between">
    <div>
        <h4>Ваши заметки: </h4>
    </div>
    <div>
        <a type="button" href="<?= \yii\helpers\Url::to(['notes/create']) ?>" class="btn btn-success">
            Добавить заметку
        </a>
    </div>
</div>
<div class="row">
    <?php foreach ($dataProvider as $note): ?>
        <div class="col-4 p-1">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title"><?= $note->title ?></h5>
                        </div>
                        <div>
                            <a href="<?= \yii\helpers\Url::to(['notes/update','id' => $note->id]) ?>" class="mx-1"><i class="fa fa-pencil"></i></a>
                            <a href="<?= \yii\helpers\Url::to(['notes/delete','id' => $note->id]) ?>" data-method="post" data-confirm="Вы уверены, что хотите удалить эту заметку?"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                    <p class="card-text"><?= $note->content ?></p>
                </div>
                <div class="card-footer">
                    <div class="notes-tags">
                        <?php foreach ($note->notesTags as $tag): ?>
                            <span class="m-1">#<?= $tag->name ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="d-flex justify-content-between my-4">
        <div class="pagination-info">
            <p><?= Yii::t('app', 'Показано с 1 по') ?> <?= $pageSize > $totalCount ? $totalCount : $pageSize ?> <?= Yii::t('app', 'из') ?> <?= $totalCount ?></p>
        </div>
        <?= \yii\bootstrap5\LinkPager::widget([
            'pagination' => $pageNum
        ]) ?>
    </div>
</div>