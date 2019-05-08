$(function() { 
    $(window).scroll(function() { 
        if($(this).scrollTop() > 100) {
            $('#toTop').fadeIn();
            
            document.getElementById('container-header').style.position = 'fixed';
            document.getElementById('container-header').style.width = '100%';
            document.getElementById('container-header').style.marginTop = '-100px';
        } else { 
            $('#toTop').fadeOut();
            document.getElementById('container-header').style.position = 'static';
            document.getElementById('container-header').style.marginTop = '0';
            document.getElementById('container-header').style.width = 'auto';            
        }

    });
$('#toTop').click(function() {
    $('body,html').animate({scrollTop:0},500);
});
});

