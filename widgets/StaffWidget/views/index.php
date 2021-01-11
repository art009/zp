<?php
use yii\helpers\Html;
/* @var $person app\models\Staff */
?>


<div class="row staff-items">
    <?php foreach($staff as $person):?>
        <div class="col-md-4">
            <div class="staff-item text-center">
                <div class="staff-img">
                    <?=Html::img($person->getImgLink(),[
                        'alt' => $person->name,
                        'class' => 'img-thumbnail',
                    ])?>
					<div class="btns-block">
						<?php if($person->is_record):?>
							<?=Html::a('Записаться', [
								'/site/contact-form',
								'person' => $person->id,
								'goal' => $goal['form'],
							],[
								'data-title' => 'Записаться к врачу',
								'onclick' => 'callContactForm(this,event)',
								'data-goal' => $goal['button'],
							])?>
						<?php endif;?>
						<?php if($person->is_online):?>
							<?=Html::a('Консультация online', [
								'/site/contact-form',
								'person' => $person->id,
								'goal' => $goal['form'],
							],[
								'data-title' => 'Консультация online',
								'onclick' => 'callContactForm(this,event)',
								'data-goal' => $goal['button'],
							])?>
						<?php endif;?>
						<?php if($person->is_home):?>
							<?=Html::a('Вызов на дом', [
								'/site/contact-form',
								'person' => $person->id,
								'goal' => $goal['form'],
							],[
								'data-title' => 'Вызов на дом',
								'onclick' => 'callContactForm(this,event)',
								'data-goal' => $goal['button'],
							])?>
						<?php endif;?>
					</div>
                </div>
                <p class="h6">
                    <?php if($person->page):?>
                        <?=Html::a($person->name,$person->page->getUrlPage())?>
                    <?php else:?>
                        <?=$person->name?>
                    <?php endif;?>
                </p>
                <p><?=$person->position?></p>
            </div>
        </div>
    <?php endforeach;?>
</div>