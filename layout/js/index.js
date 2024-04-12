$('input').each(function() {
    if ($(this).attr('required') == 'required') {
        $(this).after('<span class="reqet">*</span>');
    }
});

$(".cat h3").click(function() {
    $(this).next().next(".full-view").fadeToggle(300);
});
$(".ordering.pull-right span").click(function() {
    $(this).addClass('active').siblings('span').removeClass('active');
    if ($(this).data('view') == 'full') {
        $(".cat .full-view").fadeIn(300);
    } else {
        $(".cat .full-view").fadeOut(300);

    }
});