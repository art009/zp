<div class="row main-block-items">
    <?php foreach ($services as $service):?>
        <div class="col-md-6 col-sm-12 main-block-item">
            <div class="photobox photobox_type11">
                <div class="photobox__previewbox" data-url="<?=$service['link']?>">
                    <a href="<?=$service['link']?>"><img src="<?=$service['img']?>" class="photobox__preview" alt="<?=$service['name']?>"></a>
                    <span class="photobox__label"><?=$service['name']?></span>
                </div>
            </div>
            <div>
                <a class="main-widget-menu" href="<?=$service['link']?>"><?=$service['name']?></a>
            </div>
        </div>
    <?php endforeach;?>

</div>