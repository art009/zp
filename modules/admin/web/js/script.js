// сохранение формы в модальном окне
function save_form(th)
{
    var form = $(th).parents("div.modal").find("form"),
        url = $(form).attr('action');
    $.post(url,form.serialize(),function(data){
        $('#modif-pages div.modal-body').html(data);
    });
}
// вызов формы в модальном окне
function set_redirect(th,e)
{
    e.preventDefault();
    $('#modif-pages').modal('show');
    var url = $(th).attr('href');
    $.post(url,{},function(data){
        $('#modif-pages div.modal-body').html(data);
    });
}
// удаление редиректа
function dm_redirect(th,e)
{
    e.preventDefault();
    var url = $(th).attr('href');
    $.post(url,{},function(data){
        $(th).parents('tr').remove();
    });
}
// генерация посзагрузки галереи
function fileUploadDone (e, data, th) {
    if (e.isDefaultPrevented()) {
        return false;
    }
    var that = $(th).data('blueimp-fileupload') ||
            $(th).data('fileupload'),
        getFilesFromResponse = data.getFilesFromResponse ||
            that.options.getFilesFromResponse,
        files = getFilesFromResponse(data),
        template,
        deferred;

    if (data.context) {
        $(data.context).remove();
        askGallery(window.galleryUpdateUrl);
    } else {
        template = that._renderDownload(files)[
            that.options.prependFiles ? 'prependTo' : 'appendTo'
            ](that.options.filesContainer);
        that._forceReflow(template);
        deferred = that._addFinishedDeferreds();
        askGallery(window.galleryUpdateUrl);
    }
}

// отражать модальное окно
function showModal(header,content,footer) {
    var modal_window = $('#admin-modal'),
        close_btn = '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
    modal_window.modal('show');
    if (header.length > 0)
        modal_window
            .find('.modal-header')
            .html(close_btn + header);

    if (content.length > 0)
        modal_window
            .find('.modal-body')
            .html(content);

    if (footer.length > 0)
        modal_window
            .find('.modal-footer')
            .html(footer).show();
    else modal_window
        .find('.modal-footer').hide();

    modal_window.modal('show');
    modal_window.on('hide.bs.modal', function (e) {
        modal_window
            .find('.modal-header')
            .html('');
        modal_window
            .find('.modal-body')
            .html('<div class="center-block" style="text-align:center;"><i class="fa fa-spinner fa-pulse"></i></div>');
        modal_window.find('.modal-footer')
            .html(footer);
    })
}
// форма загрузки файла
function uploadForm(url)
{
    $.post(url,{},function(data){
        if (data.status == true)
            showModal(data.header,data.content,'');
    });
}
// отметка параметров
function selectValue(th) {
    let el = $(th),
        name_search = el.attr('data-targer'),
        input_search = $('#' + name_search),
        attr = input_search.attr('disabled');
    if (typeof attr !== typeof undefined && attr !== false) {
        input_search.removeAttr('disabled');
    } else {
        input_search.attr('disabled','disabled');
        input_search.val('');
    }
}
// загрузка файла импорта
function submitCSV(th)
{
    var el = $(th),
        form = el.parents('form'),
        url = $(form).attr('action'),
        formData = new FormData($(th).parents('form')[0]);

    $.ajax({
        url: url,
        type: 'POST',
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },
        success: function (data) {
            if (data.status == true)
                showModal(data.header,data.content,'');
        },
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    });
    return false;
}
// смена статуса заказа
function chStatusRecord(th)
{
    let el = $(th),
        value = el.attr('data-value'),
        url = el.attr('data-url'),
        attribute = el.attr('data-attribute');
    var id = el.attr('data-id-order');
    $.post(url,{
        value: value,
        name: attribute
    },function(data){
        updateListTotal(id);
        updateListProduct(id);
    });
}

// изменение аттрибута
function chAttribute(th)
{
    var el = $(th),
        url = el.attr('data-url'),
        value = el.val(),
        name = el.attr('data-name');
    $.post(url,{
        value: value,
        name: name
    },function (data){
        if (data.status == true){
            updateListTotal(id);
        }
            // console.log('success');
    })
}

// fix for remember collapce sidebar
$.AdminLTESidebarTweak = {};

$.AdminLTESidebarTweak.options = {
    EnableRemember: true,
    NoTransitionAfterReload: false
    //Removes the transition after page reload.
};

$(function () {
    "use strict";
    $("body").on("collapsed.pushMenu", function(){
        if($.AdminLTESidebarTweak.options.EnableRemember){
            var toggleState = 'opened';
            if($("body").hasClass('sidebar-collapse')){
                toggleState = 'closed';
            }
            document.cookie = "toggleState="+toggleState;
        }
    });

    if($.AdminLTESidebarTweak.options.EnableRemember){
        var re = new RegExp('toggleState' + "=([^;]+)");
        var value = re.exec(document.cookie);
        var toggleState = (value != null) ? unescape(value[1]) : null;
        if(toggleState == 'closed'){
            if($.AdminLTESidebarTweak.options.NoTransitionAfterReload){
                $("body").addClass('sidebar-collapse hold-transition').delay(50).queue(function(){
                    $(this).removeClass('hold-transition');
                });
            }else{
                $("body").addClass('sidebar-collapse');
            }
        }
    }
});

// форма смены пароля
function changePassword(th,e)
{
    e.preventDefault();
    var el = $(th),
        url = el.attr('href');
    $.post(url,{},function(data){
        if (data.status == true)
            showModal('Смена пароль',data.content,'');
    });
}
// сохранить новый пароль
function saveNewPassword(th)
{
    var el = $(th),
        form = el.closest('form'),
        url = $(form).attr('action');
    $.post(url,$(form).serialize(),function(data){
        if (data.status == true)
            showModal('Смена пароль',data.content,'');
    });
}
// закрыть модальную окно в админке
function closeModal(th) {
    let el = $(th),
        modal = el.closest('#admin-modal');
    $(modal[0]).modal('hide');
}
// очистить форму
function clearForm (th) {
    $(th).closest('form').reset();
}
// pjax установить фильтр
function setFilter(th)
{
    var form = $(th).closest('form'),
        data = $(form).serialize(),
        url = $(form).attr('action'),
        container_id = '#basket-pjax',
        box = $(container_id).find('div.box');

    $('.control-sidebar').removeClass('control-sidebar-open');

    $(box).append('<div class="overlay"> <i class="fa fa-refresh fa-spin"></i> </div>');

    $.pjax.reload({
        url: url,
        method: 'POST',
        container: container_id,
        data: data
    });
}
// pjax обновление при пагинации
function pageSelect(th,e)
{
    let form = $('#filter-form'),
        el = $(th),
        container_id = '#basket-pjax',
        url = el.attr('href'),
        box = $(container_id).find('div.box');

    e.preventDefault();

    $(box).append('<div class="overlay"> <i class="fa fa-refresh fa-spin"></i> </div>');

    $.pjax.reload({
        url: url,
        method: 'POST',
        container: container_id,
        data: form.serialize(),
    });
}
// проверка наличия аттрибута у элемента
function hasAttribute(el,attribute) {
    var attr = $(el).attr(attribute);
    if ( (typeof attr !== typeof undefined) && (attr !== false) ) {
        return true;
    } else {
        return false;
    }
}
// сменить статус отзыва
function changeStatusReview(th,e)
{
    e.preventDefault();

    var el = $(th),
        url = el.attr('href'),
        value = el.attr('data-value'),
        attribute = el.attr('data-attribute');
    $.post(url,{
        value: value,
        attribute: attribute
    }, function (data){
        if(data.status == true)
            el.hide();
        else
            alert ('Возникла ошибка.');
    });
}
// привязка сотрудников к страницам
function addStaff(data)
{
    let st_pages = $('#pages-persons_id').val(),
        ar_pages = [];
    if (st_pages.length > 0) {
        ar_pages = st_pages.split(',');
        if (ar_pages.indexOf(data.id) === -1)
        {
            // ar_pages.push(data.id);
            addPageRow(data,'table-pages')
        }
    } else {
        // ar_pages.push(data.id);
        addPageRow(data,'table-pages')
    }
    recallStaff();
}
var addPageRow = function(data,table_id)
{
    let tr_page = $('<tr>'),
        td_page_pos = $('<td>').html('<i class="fa fa-arrows-alt"></i>'),
        td_page_name = $('<td>'),
        td_page_rm = $('<td>').append($('<a>').attr('href','#').attr('onclick','rmPageRow(this,event)').text('Удалить'));
    tr_page.attr('data-id',data.id).append(td_page_pos).append(td_page_name.text(data.text)).append(td_page_rm);
    $('#' + table_id).append(tr_page);
}

var rmPageRow = function(th,e)
{
    e.preventDefault();
    var row  = $(th).closest('tr');
    row.remove();
    recallStaff();
}
// пересчитать сотрудников
var recallStaff = function ()
{
    var table = $('#table-pages'),
        input = $('#pages-persons_id'),
        array_res = [];
    table.find('tr[data-id]').each(function(){
        array_res.push($(this).attr('data-id'));
    });

    input.val(array_res.join(','));
}
// пересчитать сотрудников
var recallPrice = function ()
{
    var table = $('#table-price'),
        input = $('#pages-price_id'),
        array_res = [];
    table.find('tr[data-id]').each(function(){
        array_res.push($(this).attr('data-id'));
    });

    input.val(array_res.join(','));
}
// меняем отзыв
var chReview = function(th,e)
{
    e.preventDefault();
    let url = $(th).attr('href');
    $.post(url,[],function(data){
        if (data.hide == true) {
            $(th).closest('div').remove();
        }
        if (data.remove == true) {
            $(th).closest('div.box-comment').next('hr').remove();
            $(th).closest('div.box-comment').remove();
        }
    });
}

var deleteReview = (th,e) =>
{
    e.preventDefault();

    let url = $(th).attr('href'),
        id = $(th).attr('data-id');
    $.post(url,{'id': id},function(data){
        if (data.remove == true) {
            $(th).closest('div.box-comment').next('hr').remove();
            $(th).closest('div.box-comment').remove();
        }
    });
}
// добавление в админке позиции со стоимостью в прайс
const addItemPrice = (th,e) =>
{
    e.preventDefault();

    let form = $(th).closest('form'),
        url = $(form).attr('action'),
        data = $(form).serializeArray();
    $.post(url,data,function(data){
        if (data.status == true) {
            let table = $('#list-price-items'),
                tr = $('<tr>').append(
                    $('<td>').text(data.item.item)
                ).append(
                    $('<td>').text(data.item.price)
                ).append(
                    $('<td>').append(
                        $('<a>')
                            .addClass('btn btn-danger btn-xs btn-flat')
                            .attr('href',data.item.delete_link)
                            .attr('onclick','deleteItemPrice(this,event)')
                            .html('<i class="fas fa-trash-alt"></i>')
                    )
                );
            table.append(tr);
            //почистим форму
            $('#priceitems-item').val('');
            $('#priceitems-price').val('');
        }
    });
}
// удаление в админке позиции со стоимостью в прайс
const deleteItemPrice = (th,e) =>
{
    e.preventDefault();

    let url = $(th).attr('href');
    $.post(url, {},function(data){
        if (data.status == true) {
            $(th).closest('tr').remove();
        }
    });
}
// привязка сотрудников к страницам
const addPrice = (data) =>
{
    let st_pages = $('#pages-price_id').val(),
        ar_pages = [];
    if (st_pages.length > 0) {
        ar_pages = st_pages.split(',');
        if (ar_pages.indexOf(data.id) === -1)
        {
            // ar_pages.push(data.id);
            addPagePrice(data,'table-price')
        }
    } else {
        // ar_pages.push(data.id);
        addPagePrice(data,'table-price')
    }
    recallPrice();
}
// удаление привязки страницы и прайса
const rmPagePriceRow = (th,e) =>
{
    e.preventDefault();
    let url = $(th).attr('href');
    $.post(url,{},(data)=>{
        // if (data.status == true)
        $(th).closest('tr').remove();
    })
    recallPrice();
}

const addPagePrice = (data,table_id) =>
{
    let tr_page = $('<tr>'),
        td_page_name = $('<td>'),
        td_page_rm = $('<td>').append($('<a>').attr('href',data.delete_link).attr('onclick','rmPagePriceRow(this,event)').text('Удалить'));
    tr_page.attr('data-id',data.id).append(td_page_name.text(data.text)).append(td_page_rm);
    $('#' + table_id).append(tr_page);

}

