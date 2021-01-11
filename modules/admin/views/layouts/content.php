<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
use yii\helpers\Html;

?>
<div class="content-wrapper">
    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])):?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php else : ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo \yii\helpers\Html::encode($this->title);
                } else {
                    echo \yii\helpers\Inflector::camel2words(
                        \yii\helpers\Inflector::id2camel($this->context->module->id)
                    );
                    //echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                } ?>
            </h1>
        <?php endif; ?>

        <?= Breadcrumbs::widget(
            [
                'homeLink' => [
                    'label' => 'Панель управления',
                    'url' => ['/admin/default'],
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <?=Yii::powered()?> v.<?=Yii::getVersion()?> Latest <?=Html::img('https://poser.pugx.org/yiisoft/yii2-app-basic/v/stable.png')?>
</footer>

<?php if (isset($this->params['right']))
    echo $this->render(
        'right',
        [
            'tabs' => $this->params['right'],
            'directoryAsset' => $directoryAsset,
        ]);
?>
