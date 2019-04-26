$(function() { 
    $(window).scroll(function() { 
        if($(this).scrollTop() != 0) {
            $('#toTop').fadeIn();
        } else { 
            $('#toTop').fadeOut(); 
        }

    });
$('#toTop').click(function() {
    $('body,html').animate({scrollTop:0},500);
//    Меняем цвет блока по нажатию
    document.getElementById('container-header').style.backgroundColor = 'yellow'; 
});
});

