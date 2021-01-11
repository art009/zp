<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dmstr\widgets\Alert;
use dosamigos\switchinput\SwitchBox;
use app\models\Menu;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\widgets\ActiveForm */
//echo $model->type;
if ($model->type == Menu::TYPE_LINK) {
$js = <<<JS
	$(".field-menu-url").show();
	$(".field-menu-page").hide();
JS;
} else {
$js = <<<JS
	$(".field-menu-url").hide();
	$(".field-menu-page").show();
JS;
}
echo $this->registerJs($js);
?>
<?=Alert::widget()?>

<?php $form = ActiveForm::begin([
    'action' => Yii::$app->urlManager->createUrl(['/admin/menu/update-point','id' => $model->id])
]); ?>

    <?= $form->field($model, 'type')->widget(SwitchBox::className(),[
        'options' => [
            'uncheck' => false,
        ],
        'clientOptions' => [
            'size' => 'normal',
            'onColor' => 'success',
            'offColor' => 'danger',
            'onText' => 'Page',
            'offText' => 'Url',
            'state' =>  ($model->type == Menu::TYPE_PAGE),
        ],
        'inlineLabel' => false,
        'clientEvents' => [
            'switchChange.bootstrapSwitch' => 'function(event, state) {
                    if (state) {
                        $("#menu-type").val(0);
                        $(".field-menu-url").hide();
                        $(".field-menu-page").show();
                    } else {
                        $("#menu-type").val(1);
                        $(".field-menu-url").show();
                        $(".field-menu-page").hide();
                    }
                }'
        ],
    ]);?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'page')->dropDownList(\app\models\Pages::listPages($model->categoryMenu->depart),['prompt' => 'Выберите страницу...']) ?>

    <?= $form->field($model, 'parent')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'position')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'category_id')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::button('Сохранить', [
            'class' => 'btn btn-primary',
            'data-wrap' => '#form-menu',
            'onclick' => 'tree_save_form(this,event)',
        ]) ?>
    </div>

<?php ActiveForm::end(); ?>

