// конвертация размера в человеко понятный формат
function humanFileSize(bytes, si) {
    var thresh = si ? 1000 : 1024;
    if(Math.abs(bytes) < thresh) {
        return bytes + ' B';
    }
    var units = si
        ? ['kB','MB','GB','TB','PB','EB','ZB','YB']
        : ['KiB','MiB','GiB','TiB','PiB','EiB','ZiB','YiB'];
    var u = -1;
    do {
        bytes /= thresh;
        ++u;
    } while(Math.abs(bytes) >= thresh && u < units.length - 1);
    return bytes.toFixed(1)+' '+units[u];
}

// генерация блока
function generateItem(url_previes, url_img, alt_text, filename, file_size, modif_url, delete_url, main) {
    var img = $('<img>').attr('src',url_previes).attr('alt',alt_text),
        img_wrap = $('<span>').addClass('mailbox-attachment-icon has-img').append(img),

        link_fancybox = $('<a>').
            addClass('mailbox-attachment-name').
            attr('href',url_img).
            attr('onclick','showImage(event,this)').
            html('<i class="fa fa-camera"></i> ' + filename),

        wrap_link_fancybox = $('<p>').addClass('ellipsis').append(link_fancybox),

        link_modif = $('<a>').
            addClass('btn btn-default btn-xs pull-right').
            attr('href',modif_url).
            attr('onclick','modifImage(event,this)').
            html('<i class="fa fa-pencil"></i>'),

        link_delete = $('<a>').
            addClass('btn btn-default btn-xs pull-right').
            attr('href',delete_url).
            attr('onclick','deleteImage(event,this)').
            html('<i class="fa fa-trash"></i>'),

        wrap_control_block = $('<span>').
            addClass('mailbox-attachment-size').
            html(humanFileSize(file_size)).
            append(link_modif).
            append(link_delete),

        wrap_info = $('<div>').
            addClass('mailbox-attachment-info').
            append(wrap_link_fancybox).
            append(wrap_control_block);
        if (main == 1)
            wrap_info.addClass('main');
    return $('<li>').append(img_wrap).append(wrap_info);
}
// изображение в модальном окне
function modifImage(e,th) {
    e.preventDefault();
    var url = $(th).attr('href'),
        modal_form = $('#modif-photo');
    $.post(url,{},function(data){
        modal_form.find('.modal-footer').show();
        modal_form.find('.modal-body').empty().append(data);
        modal_form.modal('show');
    });
}
// изображение в модальном окне
function showImage(e,th) {
    e.preventDefault();
    var img = $('<img>').
        addClass(' img-responsive').
        attr('src',$(th).attr('href')),
        modal_form = $('#modif-photo');
    modal_form.find('.modal-footer').hide();
    modal_form.find('.modal-body').empty().append(img);
    modal_form.modal('show');
}
// удаление изображения
function deleteImage(e,th) {
    e.preventDefault();

    var url = $(th).attr('href');
    $(th).addClass('disabled');
    $.post(url,{},function(data){
        $(th).parents('li').remove();
    });
}
// отразить галерею
function askGallery(url) {
    $.post(
        url,
        {},
        function (data) {
            var main_wrap = $('<ul>').addClass('mailbox-attachments clearfix');
            for (var i=0, l=data.length; i<l ;i++) {

                main_wrap.append(
                    generateItem(
                        data[i].thumbnailUrl,
                        data[i].url,
                        data[i].name,
                        data[i].name,
                        data[i].size,
                        data[i].modifUrl,
                        data[i].deleteUrl,
                        data[i].main
                    )
                );
            }
            $('#photo-block').empty().append(main_wrap);
        }
    );
}
// сохранение формы в модальном окне
function save_foto_desc(th)
{
    var form = $(th).parents("div.modal").find("form"),
        url = $(form).attr('action');
    $.post(url,form.serialize(),function(data){
        $('#modif-photo div.modal-body').html(data);
    });
}