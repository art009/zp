$(document).ready(function () {
    // initMainSlider();
    initLinkServices();
    hideAsideMenu();
    init_counter_position();
    // setDropDownMainMenu();
    sliderMenu();
    initCallContactForm();

    startCalculator();

    // меню
    $('.first-button').on('click', function () {
        $('.animated-icon1').toggleClass('open');
    });
    $('.second-button').on('click', function () {

        $('.animated-icon2').toggleClass('open');
    });
    $('.third-button').on('click', function () {
        $('.animated-icon3').toggleClass('open');
    });

    $('.bvi-link-copy').remove();

});
// инициализация менюшки снизу
var sliderMenu = function()
{
    $(window).scroll(function(){
        let scrollBottom = $(window).scrollTop() + $(window).height(),
            hw = $(document).outerHeight(true);
        if ( hw - scrollBottom <= 324 ){
            $('#slider-menu').addClass('bottom');
        } else {
            $('#slider-menu').removeClass('bottom');
        }
    });
}
// инициализация ссылок виджета Сервис на главной
var initLinkServices = function () {
    if ($('.photobox__previewbox').length > 0)
        $('.photobox__previewbox').click(function () {
            window.location.href = $(this).attr('data-url');
        });
};

// инициализация Slick Slider
var initMainSlider = function()
{
    const slider = $('.main-slider');
    if (slider.length > 0) {
        slider.slick({
            dots: true
        });
    }
}
// окно времени работы
var workTime = function (th, e) {
    e.preventDefault();
    const url = $(th).attr('href');
    // console.log(url);return false;
    $.get(url, '', function (data) {
        showModal('Время работы центров', data, '');
    });
};
// отправить отзыв
var sendReviews = function (th, e) {
    e.preventDefault();
    const form = $(th).closest('form'),
        url = form.attr('action'),
        formData = new FormData(form[0]);

    $.ajax({
        url: url,
        type: 'POST',
        success: function (data) {
            showModal(data.header, data.message, '');
            if (data.status == true)
                $(form)[0].reset();
        },
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    });
};

var showModal = function (header, content, footer)
{
    const modal_window = $('#modal-window'),
        close_btn = '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    modal_window.modal('show');
    if (header.length > 0)
        modal_window
            .find('.modal-header')
            .html('<h5  class="modal-title">' + header + '</h5>' + close_btn);

    if (content.length > 0)
        modal_window
            .find('.modal-body')
            .html(content);

    if (footer.length > 0)
        modal_window
            .find('.modal-footer')
            .html(footer);
    else modal_window
        .find('.modal-footer')
        .hide();

    modal_window.modal('show');
    modal_window.on('hide.bs.modal', function (e) {
        modal_window
            .find('.modal-header')
            .html('');
        modal_window
            .find('.modal-body')
            .html('<div class="center-block" style="text-align:center;"><i class="fa fa-spinner fa-pulse"></i></div>');
        modal_window.find('.modal-footer')
            .html(footer)
            .show();
    })
}
// закрыть модальную окно в админке
var closeModal = function (th) {
    let el = $(th),
        modal = el.closest('#modal-window');
    $(modal[0]).modal('hide');
}
// вызов формы сонтактов
var callContactForm = function (th, e) {
    e.preventDefault();
    const url = $(th).attr('href'),
        get_data = [];
    if ($(th).attr('data-goal') !== undefined) {
        yaGoal($(th).attr('data-goal'));
    }

    $.get(url, get_data, function (data) {
        let title_modal = $(th).attr('data-title');
        showModal(title_modal, data, '');
    });
};
// отправка формы контактов
var sendContact = function (th, e) {
    e.preventDefault();

    const form = $(th).closest('form'),
        url = form.attr('action'),
        formData = new FormData(form[0]),
        goal = $(th).attr('data-goal');

    $.ajax({
        url: url,
        type: 'POST',
        success: function (data) {
            //console.log(data);
            if (data.status == true) {
                showModal(data.header, data.message, '');
                $(form)[0].reset();
                yaGoal(goal);
            } else {
                $(form).find('.alert').remove();
                $(form).prepend(data.message);
            }
        },
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    });
};
// скроем меню 3-го уровня
var hideAsideMenu = function () {
    // return false;
    $('aside ul li ul li ul').hide();
    $('aside ul li ul li.active').parent('ul').show();
    $('aside ul li ul li.active')
        .parent('ul')
        .prev('a')
        .children('i')
        .addClass('fa-caret-down')
        .removeClass('fa-caret-right');
    $('aside ul li ul li > a[href="#"]').click(function (e) {
        e.preventDefault();
        $(this).next('ul').toggle('slow');
        let curret = $(this).children('i');
        if ($(curret).hasClass('fa-caret-right')) {
            $(curret).addClass('fa-caret-down').removeClass('fa-caret-right');
        } else {
            $(curret).addClass('fa-caret-right').removeClass('fa-caret-down');
        }

    });
};

// расчет положения счетчика на главной
var init_counter_position = function () {
    let wrap_counter = $('.wrap-counter');
    if (wrap_counter.length <= 0)
        return false;
    let baner_width_def = 1110,
        banner = wrap_counter.closest('div.slick-slide'),
        baner_width_curent = $(banner).width(),
        persent_width = baner_width_curent / baner_width_def;

    wrap_counter.removeAttr('style');
    const wrap_counter_font_size = wrap_counter.css('font-size'),
        wrap_counter_top = wrap_counter.css('top'),
        wrap_counter_left = wrap_counter.css('left'),
        wrap_counter_letter_spacing = wrap_counter.css('letter-spacing');
    wrap_counter.css('font-size', Math.round(wrap_counter_font_size.replace('px', '') * persent_width) + 'px');
    wrap_counter.css('top', Math.round(wrap_counter_top.replace('px', '') * persent_width) + 'px');
    wrap_counter.css('left', Math.round(wrap_counter_left.replace('px', '') * persent_width) + 'px');
    wrap_counter.css('letter-spacing', Math.round(wrap_counter_letter_spacing.replace('px', '') * persent_width) + 'px');
};
// скролинг
var scrollTo = function (th, e) {
    e.preventDefault();
    let id = $(th).attr('href');
    let top = $(id).offset().top;//узнаем высоту от начала страницы до блока на который ссылается якорь
    //анимируем переход на расстояние - top за 1500 мс
    $('body,html').animate({scrollTop: top}, 1500);
};

var yaGoal = function (goal) {
    // let counter = yaCounter7736377;
    // console.log('goal', goal)
    if (typeof yaCounter7736377 !== 'undefined') {
        yaCounter7736377.reachGoal(goal);
    }
};

var setDropDownMainMenu = function ()
{
    let wrap_menu = $('.main-menu'),
        ul_menu = wrap_menu.find('ul'),
        li_list = $(ul_menu).children('li.list-item'),
        max_items = 5,
        prev_items = max_items-1;

    if ( $(li_list).length > max_items + 1 ) {
        let max_width = 0,
            lists_item = $(ul_menu).find('li.list-item:gt('+prev_items+')'),
            wrap_dropdown = $('<li>').addClass('list-item col-2 dropdown').append('<ul>');

        for (let i=0,l=$(lists_item).length;i<l;i++) {
            if (lists_item[i].offsetWidth > max_width) {
                max_width = lists_item[i].offsetWidth;
            }
        }

        wrap_dropdown.find('ul').css({
            'width' : max_width+'px'
        });

        $(ul_menu).find('li.list-item:gt('+prev_items+')').wrapAll(wrap_dropdown);
        $(ul_menu).find('li.list-item:gt('+prev_items+')').removeClass('col-2');
        $(ul_menu).find('li.list-item:eq('+max_items+')').prepend('<a href="#">Ещё</a>');

    }
}

var workTime = function (th, e) {
    e.preventDefault();
    const url = $(th).attr('href');
    // console.log(url);return false;
    $.get(url, '', function (data) {
        showModal('Время работы центров', data, '');
    });
};
// всем ссылкам с якорем #call_contact_form задаем значение
var initCallContactForm = function()
{
    let links = $('a[href="#call_contact_form"]');
    if (links.length > 0)
        links
            .attr('onclick','callContactForm(this,event)')
            .attr('href','/site/contact-form')
            .attr('data-title','Записаться к врачу');
}
//переключить мобильное меню
var showMobileMenu = function(th,e)
{
    e.preventDefault();

    let $aside = $('aside');
    if ($aside.hasClass('show')) {
        $aside.removeClass('show');
        $('body').css('overflow-y','auto');
    } else {
        $aside.addClass('show');
        $('body').css('overflow-y','hidden');

    }
}

var startCalculator = function()
{
    window.def = {
        quest: $('#quest').text(),
        option: $('#option').text(),
        optionValue: $('#optionValue').text(),
        optionKoeff: $('#optionKoeff').text()
    };
    addChild();
}
function addChild()
{
    if ( $('#docorder').length <= 0 )
        return false;
    if ($('#docorder').find('.child').length > 0) {
        alert('Заполните до конца форму!');
        return false;
    }
    let fieldfn = doT.template($('#wrap-child').html()),
        select = data;
    $('#docorder').append(fieldfn(initLoacation()));
    addQuest(select);
    setNumberChild();
}

function nextQuery(th)
{
    let el = $(th),
        val = el.val(),
        next_data = data,
        data_prev = el.attr('data-prev'),
        wrap_ch = el.parents('.full-inform,.child');

    if ($(wrap_ch).hasClass('full-inform')) {
        // удалим незаполненую форму
        $('#docorder').children('.child').remove();
        // выставим тек запись
        $(wrap_ch).removeClass('full-inform').addClass('child');
    }

    let el_row = $(el).parents('.form-group'),
        el_next = el_row.next('div');
//        console.log(el_next);

    while(el_next.length > 0){
        $(el_next).remove();
        el_next = el_row.next('div');
    }

    if (typeof data_prev !== typeof undefined && data_prev !== false)
    {
        data_prev = data_prev + '_' + val;
        let levels = data_prev.split('_');
        for(var i = 0, l = levels.length; i<l; i++)
        {
            next_data = next_data.items[levels[i]];
        }
        data_prev = data_prev + '_' + val;
    } else {
        next_data = next_data.items[val];
        data_prev = val;
    }

    next_data['data_prev'] = data_prev;

    addQuest(next_data);
}

function nextLocation()
{
    var fieldfn = doT.template($('#location').html(), undefined, window.def);
    $('#docorder').children('.child').append(fieldfn(initLoacation()));
    $('#docorder').children('.child').removeClass('child').addClass('full-inform');
}

function addQuest(data)
{
    var fieldfn = doT.template($('#quest').html(), undefined, window.def);
    $('#docorder').children('.child').append(fieldfn(data));
}

function skidka(count_childs)
{
    let persent = 1;
    if(count_childs == 2) persent = 0.97;
    if(count_childs == 3) persent = 0.95;
    if(count_childs >= 4) persent = 0.93;
    return persent;
}

function initLoacation()
{
    return {
        1: 'Москва в пределах МКАД',
        1.15: 'Митино, Северное Бутово, Жулебино, Ново-Косино, Солнцево',
        1.3: '0-5 км от МКАД',
        1.5: '5,1-10 км от МКАД',
        1.75: '10,1-20 км от МКАД',
        2: '20,1-25 км от МКАД',
        3: '25,1-40 км от МКАД',
        3.5: '40,1-50 км от МКАД',
        4: '50,1-60 км от МКАД',
        4.5: '60,1-70 км от МКАД',
        5: '70,1-80 км от МКАД',
        6: '80,1-100 км от МКАД'
    };

}

function calcTotal()
{
    var childen = $('.full-inform'),
        total = 0,
        koeff = 0,
        price = 0,
        count_child = childen.length;

    for(var i = 0; i<count_child; i++) {
        koeff = $(childen[i]).find('[data-price]').val();
        price = $(childen[i]).find('[data-koeff]').val();
        total = total + koeff*price;
    }

    total = Math.round( skidka(count_child) * total );

    $('#result').text(total+' руб.');
}

function removeInform(th)
{
    var wrap = $(th).parents('.child,.full-inform');
    wrap.remove();
    $('#result').text('0 руб.');
    setNumberChild();
    calcTotal();
}

function clearForm()
{
    $('#docorder').empty();
    addChild();
}

function setNumberChild()
{
    let chileds = $('#docorder > div');
    for(var i = 0, l = chileds.length; i<l; i++) {
        $(chileds[i]).find('.child_num').text(i + 1);
    };
}