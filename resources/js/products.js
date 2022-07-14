// Прикрепляем события
bindPopupEvents();
// Задаем заголовок csrf
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': window._csrf }
});

/**
 * Вспомогательная функция для создания тела запроса из формы
 * @param name
 * @returns {{data: {}, name: (*|jQuery), _token: *, id: (*|jQuery), article: (*|jQuery), status: (*|jQuery)}}
 */

function getFormData(name) {
    let form = $(`#${name}`);
    let data = {
        id: $(form).find('input[name="id"]').val(),
        name: $(form).find('input[name="name"]').val(),
        article: $(form).find('input[name="article"]').val(),
        status: $(form).find('input[name="status"]').val(),
        data: {}
    };

    let names = $(form).find('input[name="names[]"]');
    let values = $(form).find('input[name="values[]"]');

    for (let i = 0; i < names.length; i++) {
        data.data[$(names[i]).val()] =  $(values[i]).val();
    }

    return data;
}

/*
|
| Функционал для работы попапов
|
 */

/**
 * Привязка событий открытия попапов с кнопки
 */

$('*[data-action]').each((key, item) => {
    $(item).click(() => {
        openPopup($(item).data('action'), $(item).data());
    });
});

/**
 * Привязка событий закрытия попапов с кнопки
 */

$('.popup .close').each((key, item) => {
    $(item).click(() => {
        closePopup($(item).data('target'));
    });
});

/**
 * Открытие указанного попапа
 * @param name
 * @param options
 */

function openPopup(name, options) {
    closeAllPopup();
    let popup = $(`*[data-name="${name}"]`);
    popup.trigger('popup:before-open', options);
    popup.addClass('active');
}

/**
 * Закрытие указанного попапа
 * @param name
 */

function closePopup(name) {
    let popup = $(`*[data-name="${name}"]`);
    popup.removeClass('active');
    popup.trigger('popup:after-close');
}

/**
 * Закрытие всех открытых попапов
 */

function closeAllPopup(){
    let popups = $('.popup.active');
    popups.removeClass('active');
    popups.trigger('popup:after-close');
}

/**
 * Привязка событий к открытию/закрытию попапов
 */

function bindPopupEvents(){
    let createPopup = $('.popup[data-name="create-product"]');
    let updatePopup = $('.popup[data-name="update-product"]');
    let viewPopup = $('.popup[data-name="view-product"]');

    createPopup.on('popup:before-open', () => {});
    createPopup.on('popup:after-close', (ev) => {
        let popup = $(ev.target);
        popup.find('input[name="article"]').val("");
        popup.find('input[name="name"]').val("");
        popup.find('input[name="status"]').val("");
        popup.find('.selector-value').text("available");
        popup.find('.attributes-list').html("");

        popup.find('.error').removeClass('active');
        popup.find('.error').text('');
    });

    updatePopup.on('popup:before-open', (ev) => {
        let product = window.cacheProduct;
        if (product) {
            let popup = $(ev.target);
            popup.find('.title span').text(product.name);
            popup.find('*[data-id]').data('id', product.id);
            popup.find('input[name="name"]').val(product.name);
            popup.find('input[name="article"]').val(product.article);
            popup.find('input[name="status_name"]').text(product.status_name);
            popup.find('input[name="status"]').val(product.status);

            let listAttributes = popup.find('.attributes-list');
            let addAttribute = popup.find('.add');
            for (let key in product.data) {
                addAttribute.click();
                let last = listAttributes.children().last();
                last.find('input[name="names[]"]').val(key);
                last.find('input[name="values[]"]').val(product.data[key]);
                last.find('.remove').click(attributeAdd);
            }
        }
    });
    updatePopup.on('popup:after-close', (ev) => {
        let popup = $(ev.target);
        popup.find('title span').text("");
        popup.find('input[name="article"]').val("");
        popup.find('input[name="name"]').val("");
        popup.find('input[name="status"]').val("");
        popup.find('.selector-value').text("Доступен");
        popup.find('.attributes-list').html("");
        popup.find('*[data-id]').data("id", "");

        popup.find('.error').removeClass('active');
        popup.find('.error').text('');
    });

    viewPopup.on('popup:before-open', (ev, options) => {
        let id = options.id;

        if (id) {
            $.ajax({
                url: `/products/view/${id}`,
                type: 'GET',
                dataType: 'json'
            }).done((data, status, xhr) => {
                if (xhr.status === 200) {
                    let product = data.data;
                    if (product) {
                        window.cacheProduct = product;

                        let attributes = [];
                        for (let key in product.data) {
                            attributes.push(`${key}: ${product.data[key]}`);
                        }

                        let viewPopup = $('.popup[data-name="view-product"]');

                        viewPopup.find('*[data-id]').data('id', product.id);
                        viewPopup.find('*[data-name="name"]').text(product.name);
                        viewPopup.find('*[data-name="article"]').text(product.article);
                        viewPopup.find('*[data-name="status"]').text(product.status_name);
                        viewPopup.find('*[data-name="status"]').data('value', product.status);
                        viewPopup.find('*[data-name="data"]').html(attributes.join('<br>'));
                    }
                }
            });
        }
    });
    viewPopup.on('popup:after-close', (ev) => {
        let popup = $(ev.target);
        popup.find('*[data-id]').data('id', "");
        popup.find('*[data-name="name"]').text("");
        popup.find('*[data-name="article"]').text("");
        popup.find('*[data-name="status"]').text("");
        popup.find('*[data-name="status"]').data('value', "");
        popup.find('*[data-name="data"]').html("");
    });
}

/**
 * Привязка обработчика удаления строк атрибутов
 */

$('.attributes .add').each((key, item) => {
    $(item).click((ev) => {
        ev.preventDefault();
        let list = $(ev.target).prev();
        if ($(list).find('.attribute').length < 5) {
            $(list).append(getTemplateAttribute());

            let last = $(list).find('.attribute').last();
            last.find('.remove').click(attributeAdd);
        }
    });
});

/**
 * Колбэк для обработчика удаления строки атрибута
 * @param ev
 */

function attributeAdd(ev) {
    $(ev.target).parent().remove();
}

/**
 * Шаблон строки атрибутов
 *
 * @returns {string}
 */

function getTemplateAttribute() {
    return `
            <div class="attribute">
                <label>
                    <p>Название</p>
                    <input type="text" name="names[]">
                </label>
                <label>
                    <p>Значение</p>
                    <input type="text" name="values[]">
                </label>
                <button class="remove"></button>
            </div>
        `;
}


/*
|
| Конец
|
 */


/**
 * Создание продукта
 */

$('.save[data-method="create-product"]').click((ev) => {
    ev.preventDefault();

    $('.popup[data-name="create-product"] .error').removeClass('active');
    let data = getFormData('create-product-form');

    $.ajax({
        url: '/products/create',
        type: 'POST',
        dataType: 'json',
        contentType: "application/json",
        data: JSON.stringify(data)
    }).done((data, status, xhr) => {
        if (xhr.status === 201) {
            location.reload();
        }
    }).fail((xhr) => {
        if (xhr.status === 422) {
            let data = xhr.responseJSON;
            for (let key in data.errors) {
                let field = key;
                let text = data.errors[key].shift();

                let error = $(`.popup[data-name="create-product"] .error[data-field="${field}"]`);
                error.addClass('active');
                error.text(text);
            }
        }
    });
});

/**
 * Изменение продукта
 */

$('.save[data-method="update-product"]').click((ev) => {
    ev.preventDefault();

    let id = $(ev.target).data("id");

    if (id) {
        $('.popup[data-name="update-product"] .error').removeClass('active');
        let data = getFormData('update-product-form');

        $.ajax({
            url: `/products/update/${id}`,
            type: 'PUT',
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            data: JSON.stringify(data)
        }).done((data, status, xhr) => {
            if (xhr.status === 200) {
                location.reload();
            }
        }).fail((xhr) => {
            if (xhr.status === 422) {
                let data = xhr.responseJSON;
                for (let key in data.errors) {
                    let field = key;
                    let text = data.errors[key].shift();

                    let error = $(`.popup[data-name="update-product"] .error[data-field="${field}"]`);
                    error.addClass('active');
                    error.text(text);
                }
            }
        });
    }
});

/**
 * Удаление продукта
 */

$('.remove[data-method="remove-product"]').click((ev) => {
    let id = $(ev.target).data('id');

    if (id) {
        $.ajax({
            url: `/products/delete/${id}`,
            type: 'DELETE',
            dataType: 'json'
        }).done((data, status, xhr) => {
            if (xhr.status === 200) {
                location.reload();
            }
        });
    }
});
