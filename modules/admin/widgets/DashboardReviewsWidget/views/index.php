<?php
use yii\helpers\Html;
use app\models\Reviews;
?>

<div class="col-md-6">
    <!-- Box Comment -->
    <div class="box box-widget">
        <div class="box-header with-border">

            <h3 class="box-title">Новые сообщения</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php foreach ($reviews as $review):?>
                <div class="box-comment">
                    <div class="comment-text">
                        <span class="username">
                            <b><?=$review->created_name?></b>
                            <span class="text-muted pull-right"><?=date('d.m.Y H:i',$review->created_at)?></span>
                        </span><br/>
                        <?=$review->review?>
                    </div>
                    <!-- /.comment-text -->
					<?php if ($review->type == Reviews::TYPE_MODERATE):?>
						<div class="pull-left">
							<?=Html::a('<i class="fa fa-comments"></i> Вопрос',[
									'/admin/reviews/ch-review',
									'id' => $review->id,
									'status' => 0,
									'type' => Reviews::TYPE_QUESTION,
								],[
								'class' => 'btn btn-default btn-xs',
								'onclick' => 'chReview(this,event)',
								'data-id' => $review->id
							])?>
							<?=Html::a('<i class="fa fa-comment"></i> Отзыв',[
									'/admin/reviews/ch-review',
									'id' => $review->id,
									'status' => 0,
									'type' => Reviews::TYPE_REVIEWS,
								],[
								'class' => 'btn btn-default btn-xs',
								'onclick' => 'chReview(this,event)',
								'data-id' => $review->id
							])?>
						</div>
					<?php endif?>

					<?php if ($review->status == Reviews::STATUS_NEW):?>
						<div class="pull-right">
							<?=Html::a('<i class="fa fa-trash"></i> Удалить',[
								'/admin/reviews/delete',
								'id' => $review->id
							],[
								'class' => 'btn btn-default btn-xs',
								'onclick' => 'deleteReview(this,event)',
								'data-id' => $review->id
							])?>
							<?=Html::a('<i class="fa fa-share"></i> Опубликовать',[
									'/admin/reviews/ch-review',
									'id' => $review->id,
									'status' => Reviews::STATUS_ACTIVE,
									'type' => 0,
								],[
								'class' => 'btn btn-default btn-xs',
								'onclick' => 'chReview(this,event)',
								'data-id' => $review->id
							])?>
							<?=Html::a('<i class="fa fa-ban"></i> Блокировать',[
								'/admin/reviews/ch-review',
								'id' => $review->id,
								'status' => Reviews::STATUS_BLOCK,
								'type' => 0,
							],[
								'class' => 'btn btn-default btn-xs',
								'onclick' => 'chReview(this,event)',
								'data-id' => $review->id
							])?>
						</div>
					<?php endif;?>

                    <div class="clearfix"></div>
                </div>
                <hr/>
            <?php endforeach;?>

        </div>
    </div>
    <!-- /.box -->
</div>