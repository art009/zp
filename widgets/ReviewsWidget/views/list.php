<?php
use yii\widgets\ListView;
?>

<?=ListView::widget([
    'dataProvider' => $reviews,
    'emptyText' => '<p class="bg-danger">Вот удача, вы можете быть первым кто оставит отзыв!</p>',
    'itemView' => $itemView,
    'layout' => "<div class='row items-reviews'>{items}</div><nav aria-label=\"Page navigation\">{pager}</nav>",
    'summary' => "Вы просматриваете с {begin} по {end} записей из {totalCount}",
    'itemOptions' => ['class' => 'col-md-12'],
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