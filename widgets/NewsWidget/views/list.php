<?php
use yii\widgets\ListView;
?>

<?=ListView::widget([
    'dataProvider' => $articles,
    'emptyText' => '<div class="p-3 mb-2 bg-danger text-white">Мы обязательно что-нибудь напишем, заходите обязательно.</div>',
    'itemView' => '_item',
    'layout' => "<p class='text-right'>{summary}</p><div class='row news-items'>{items}</div><nav aria-label=\"Page navigation\">{pager}</nav>",
    'summary' => "Вы просматриваете с {begin} по {end} новости из {totalCount}",
    'itemOptions' => ['class' => 'col-md-4 col-xs-12 text-center'],
    'pager' => [
        'prevPageLabel' => '<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>',
        'nextPageLabel' => '<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>',
        'linkContainerOptions' => [
            'class' => 'page-item',
        ],
        'linkOptions' => [
            'class' => 'page-link',
        ],
        'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link', 'href' => '#'],
    ],
]);?>

<div class="clearfix"></div>