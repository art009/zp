<?php
use dosamigos\fileupload\FileUploadUI;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $image app\models\Gallery */

//$this->registerJsFile(Yii::$app->request->getBaseUrl(true) . '/js/admin/gallery.js',['depends' => [JqueryAsset::className()]]);

$url_list_img = Yii::$app->urlManager->createUrl(['/admin/pages/list-image','page_id' => $model->id]);

$script = <<< JS
    window.galleryUpdateUrl = "$url_list_img";
    askGallery(window.galleryUpdateUrl);
    $('#modif-photo').on('hidden.bs.modal', function () {
        askGallery(window.galleryUpdateUrl);
    })
    
JS;

$this->registerJs($script,$this::POS_READY);
?>

<?= FileUploadUI::widget([
    'model' => $image,
    'attribute' => 'file',
    'url' => ['/admin/pages/image-upload', 'id' => $model->id],
    'gallery' => true,
    'fieldOptions' => [
        'accept' => 'image/*'
    ],
    'clientOptions' => [
        'maxFileSize' => 2*1024*1024,
        'previewMaxWidth' => '100px',
        'previewMaxHeight' => '100px',
    ],
    'clientEvents' => [
        'fileuploaddone' => 'function(e, data) {fileUploadDone (e, data, this);}',
        'fileuploadfail' => 'function(e, data) {}',
    ],
]); ?>

<div id="photo-block"></div>


<div class="modal fade" id="modif-photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Редактор изображения</h4>
            </div>
            <div class="modal-body">
                <p>Загрузка...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" onclick="save_foto_desc(this)">Сохранить</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


