$(document).ready(function () {
    initMainSlider();
    initLinkServices();
    hideAsideMenu();
    init_counter_position();
});
// инициализация ссылок виджета Сервис на главной
const initLinkServices = function () {
    if ($('.photobox__previewbox').length > 0)
        $('.photobox__previewbox').click(function () {
            window.location.href = $(this).attr('data-url');
        });
};

// инициализация Slick Slider
function initMainSlider() {
    const slider = $('.main-slider');
    if (slider.length > 0) {
        slider.slick({
            dots: true
        });
    }
}

const workTime = function (th, e) {
    e.preventDefault();
    const url = $(th).attr('href');
    // console.log(url);return false;
    $.get(url, '', function (data) {
        showModal('Время работы центров', data, '');
    });
};

const sendReviews = function (th, e) {
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

const showModal = function (header, content, footer) {
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
const closeModal = function (th) {
    let el = $(th),
        modal = el.closest('#modal-window');
    $(modal[0]).modal('hide');
}
// вызов формы сонтактов
const callContactForm = function (th, e) {
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
const sendContact = function (th, e) {
    e.preventDefault();

    const form = $(th).closest('form'),
        url = form.attr('action'),
        formData = new FormData(form[0]),
        goal = $(th).attr('data-goal');

    $.ajax({
        url: url,
        type: 'POST',
        success: function (data) {
            showModal(data.header, data.message, '');
            if (data.status == true) {
                $(form)[0].reset();
                yaGoal(goal);
            }

        },
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    });
};
// скроем меню 3-го уровня
const hideAsideMenu = function () {
    $('aside ul li ul li ul').hide();
    $('aside ul li ul li.active ul').show();
    $('aside ul li ul li > a[href="#"]').click(function (e) {
        e.preventDefault();
        $(this).next('ul').toggle('slow');
    });
};

// расчет положения счетчика на главной
const init_counter_position = function () {
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
const scrollTo = function (th, e) {
    e.preventDefault();
    let id = $(th).attr('href');
    let top = $(id).offset().top;//узнаем высоту от начала страницы до блока на который ссылается якорь
    //анимируем переход на расстояние - top за 1500 мс
    $('body,html').animate({scrollTop: top}, 1500);
};

const yaGoal = function (goal) {
    let counter = yaCounter7736377;
    console.log('goal', goal)
    if (typeof counter !== 'undefined') {
        counter.reachGoal(goal);
    }
};
