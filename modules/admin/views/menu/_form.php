<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yiidreamteam\jstree\JsTree;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\CategoryMenu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-default <?=(!$model->isNewRecord)?'collapsed-box':''?>">
            <?php if(!$model->isNewRecord):?>
                <div class="box-header with-border">
                    <h3 class="box-title">Параметры блока меню</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
            <?php endif;?>
            <div class="box-body">
                <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
	            	<?= $form->field($model, 'depart')->dropDownList(\app\models\Depart::getDepartList(),[
						'prompt' => 'Выберите...',
					])?>

                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Новый блок' : 'Обновить блок', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php if(!$model->isNewRecord):?>
<div class="row">
    <div class="col-md-3">
        <div class="box box-default">
            <div class="box-header">
                <button type="button" class="btn btn-success btn-xs btn-flat" title="Добавить" data-category="<?=$model->id?>" data-url="<?=Url::to(['menu/add-point']);?>" onclick="tree_create(this);"><i class="glyphicon glyphicon-plus"></i></button>
                <button type="button" class="btn btn-warning btn-xs btn-flat" title="Переименовать" data-url="<?=Url::to(['menu/rename-point']);?>" onclick="tree_rename(this);"><i class="glyphicon glyphicon-pencil"></i></button>
                <button type="button" class="btn btn-danger btn-xs btn-flat" title="Удалить" data-url="<?=Url::to(['menu/remove-point']);?>" onclick="tree_delete(this);"><i class="glyphicon glyphicon-remove"></i></button>
                <button type="button" class="btn btn-default btn-xs btn-flat" title="Обновить" onclick="tree_refresh();"><i class="glyphicon glyphicon-refresh"></i></button>
                <button type="button" class="btn btn-default btn-xs btn-flat" title="Развернуть всё" onclick="tree_expand();"><i class="glyphicon glyphicon-collapse-down"></i></button>
                <button type="button" class="btn btn-default btn-xs btn-flat" title="Свернуть всё"  onclick="tree_collapse();"><i class="glyphicon glyphicon-expand"></i></button>
            </div>
            <div class="box-body">
                <?= JsTree::widget([
                    'containerOptions' => [
                        'id' => 'menu-tree',
                        'class' => 'data-tree',
                    ],
                    'jsOptions' => [
                        'core' => [
                            'multiple' => false,
                            'check_callback' => true,
                            'data' => [
                                'url' => Url::to(['menu/ajax-tree-js','id' => $model->id]),
                            ],
                            'themes' => [
                                'url' => '/jstree/themes/default/style.min.css',
                                'dots' => true,
                                'icons' => false,
                            ]
                        ],
                        'plugins' => [
                            'dnd', 'changed', 'state'
                        ],
                    ],
                ]) ?>
                <?php $this->registerJsFile('/jstree/page-script.js')?>
            </div>
        </div>
    </div>

    <?= $this->registerJs('
        init_dnd("' . Yii::$app->urlManager->createUrl(['/admin/menu/order-menu']) . '");
        init_click();
    ')?>

    <div class="col-md-9">
        <div class="box box-default">
            <div class="box-header with-border">
                Раздел меню
            </div>
            <div id="form-menu" class="box-body">

            </div>
        </div>
    </div>
</div>
<?php endif;?>