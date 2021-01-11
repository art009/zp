// новый пункт в дереве
function tree_create(th) {
    var ref = $('#menu-tree').jstree(true),
        sel = ref.get_selected(),
        url = $(th).attr('data-url'),
        id_category = $(th).attr('data-category');
    if(!sel.length) {
        sel = null;
    } else {
        sel = sel[0];
    }
    $('#form-menu').html('');
    sel = ref.create_node(sel, {"type":"file"});
    if(sel) {
        ref.edit(sel,'',function(el){
            var id_parent = ref.get_parent(sel);
            if ($(el).attr('text') == '') {
                ref.delete_node(sel);
                return false;
            }
            $.post(
                url,
                {
                    id_category     : id_category,
                    id_parent       : id_parent,
                    menu_name       : $(el).attr('text')
                },function(data){
                    if (typeof data.error == 'undefined') {
                        ref.set_id(sel, "js_tree_" + data.id);
                        $('#form-menu').html(data.form_data);
                    } else {
                        alert(data.error);
                    }

                }
            );
        });
    }
};
//переименовать пункт в дереве
function tree_rename(th) {
    var ref = $('#menu-tree').jstree(true),
        sel = ref.get_selected(),
        url = $(th).attr('data-url');
    if(!sel.length) { return false; }
    sel = sel[0];
    var node_text = ref.get_node(sel);

    $.post(
        url,
        {
            id_record     : sel
        },function(data){
            if (typeof data.error == 'undefined') {
                $('#form-menu').html(data.form_data);
            } else {
                alert(data.error);
            }

        }
    );

    ref.edit(sel,node_text.text,function(el){
        if ($(el).attr('text') == '') {
            ref.delete_node(sel);
            return false;
        }
        $.post(url, {
            id_record     : sel,
            menu_name     : $(el).attr('text')
        });
    });
};
// функция удаления пункта меню
function tree_delete(th) {
    var ref = $('#menu-tree').jstree(true),
        sel = ref.get_selected(),
        url = $(th).attr('data-url');
    if(!sel.length) { alert('Выделите пункт меню!');return false; }
    if (confirm('Вы уверены что хотите удалить пункт меню?')) {
        ref.delete_node(sel);
        $.get(url, {'id_remove': sel[0]}, function (data) {
            $('#form-menu').empty();
        });
    }
};
// функция обновления дерева
function tree_refresh() {
    var ref = $('#menu-tree').jstree(true);
    ref.refresh();
};
// сохранение формы
var tree_save_form = function(th,e) {
    e.preventDefault();
    $("#menu-type").attr("type","hidden");
    var parent_form = $(th).closest('form'),
        url = parent_form.attr('action'),
        id_wrap = $(th).attr('data-wrap'),
        formData = new FormData( parent_form[0] );
// console.log( formData.getAll('Menu[type]') );return false;
    $.ajax({
        url: url,
        type: 'POST',
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },
        success: function (data){
            $(id_wrap).html(data);
        },
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    });
}

// запись позиций после перемещения пунктов меню
function init_dnd(url) {
    $(document).on('dnd_stop.vakata', function (event, el) {
        var ref = $('#menu-tree').jstree(true),
            res_array = [];
            parent = ref.get_node(el.element).parent;

        if (typeof parent == 'undefined') {
            var t = $(el.event.target);
            parent = t.parent()[0].id;
        }
        var childrens = ref.get_node(parent).children;
// console.log(ref.get_node(parent).children_d);
// console.log(ref.get_node(parent).children);
        $.post(url,{
            parent_id : parent,
            childrens : childrens
        });
    });
}

// функция инициализации клика по ноде
function init_click() {
    var _selectedNodeId;
    $('#menu-tree').on("select_node.jstree", function (e, _data) {
        if ( _selectedNodeId === _data.node.id ) {
            _data.instance.deselect_node(_data.node);
            _selectedNodeId = "";
        } else {
            _selectedNodeId = _data.node.id;
        }
    });
}
// развернуть дерево
function tree_expand() {
    $('#menu-tree').jstree('open_all');
}
// свернуть дерево
function tree_collapse() {
    $('#menu-tree').jstree('close_all');
}