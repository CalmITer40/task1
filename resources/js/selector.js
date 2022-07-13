$('.selector-item').each((key, item) => {
    $(item).click((ev) => {
        let item = $(ev.target);
        let parent = $(item).closest('.selector');
        let value = $(item).data('item');

        $(parent).find('.selector-value').text($(item).text());
        $(parent).next().val(value);
    });
});

$('.selector').click((ev) => {
    let parent = $(ev.target).closest('.selector');
    $(parent).toggleClass('active');
});
