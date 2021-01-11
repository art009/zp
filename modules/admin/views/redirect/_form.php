<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Redirect */
/* @var $page app\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['action' => Url::to(['/admin/redirect/control','page_id' => $model->page_id])]); ?>
    <?= $form->field($model, 'old_url')->textInput() ?>
    <?= $form->field($model, 'model_name')->hiddenInput()->label(false) ?>
<?php ActiveForm::end(); ?>
<div class="row">
    <table class="table">
        <tr>
            <th>Ссылка</th>
            <th>Удалить</th>
        </tr>
        <?php foreach($page->redirect as $link):?>
            <tr>
                <td><?=$link->old_url?></td>
                <td><?=Html::a(
                        '<span class="glyphicon glyphicon-trash"></span>',
                        Yii::$app->urlManager->createUrl(['/admin/redirect/delete','id' => $link->id]),
                        [
                            'onclick' => 'dm_redirect(this,event)'
                    ]);
                ?></td>
            </tr>
        <?php endforeach;?>
    </table>
</div>
