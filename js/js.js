$(function() {
    var slideAuto = setInterval(slideGo, 5000);
    var slideAutoTitle = setInterval(slideGoTitle, 3000);
    $('.slide_nav_item.g').click(function() {
        slideGo();
        clearInterval(slideAuto);
    });
    $('.slide_nav_item.b').click(function() {
        slideBack();
        clearInterval(slideAuto);
    });
    $('.slide_nav_item.g').dblclick(function() {
        slideAuto = setInterval(slideGo, 5000);
    });
    // slide title
    $('.slide_nav_item_title.g').click(function() {
        slideGoTitle();
        // clearInterval(slideAuto);
    });
    $('.slide_nav_item_title.b').click(function() {
        slideBackTitle();
        // clearInterval(slideAuto);
    });

});


function slideGo() {
    if ($('.slide_item.fis').next().length) {
        $('.slide_item.fis').fadeOut(400, function() {
            $(this).removeClass('fis').next().fadeIn().addClass('fis');
        });
    } else {
        $('.slide_item.fis').fadeOut(400, function() {
            $('.slide_item').removeClass('fis');
            $('.slide_item:eq(0)').fadeIn().addClass('fis');
        });
    }
}


function slideBack() {
    if ($('.slide_item.fis').index() > 1) {
        $('.slide_item.fis').fadeOut(400, function() {
            $(this).removeClass('fis').prev().fadeIn().addClass('fis');
        });
    } else {
        $('.slide_item.fis').fadeOut(400, function() {
            $('.slide_item').removeClass('fis');
            $('.slide_item:last-of-type').fadeIn().addClass('fis');
        });
    }

}

function slideGoTitle() {
    if ($('.slide_item_title.fis').next().length) {
        $('.slide_item_title.fis').fadeOut(400, function() {
            $(this).removeClass('fis').next().fadeIn().addClass('fis');
        });
    } else {
        $('.slide_item_title.fis').fadeOut(400, function() {
            $('.slide_item_title').removeClass('fis');
            $('.slide_item_title:eq(0)').fadeIn().addClass('fis');
        });
    }
}


function slideBackTitle() {
    if ($('.slide_item_title.fis').index() > 1) {
        $('.slide_item_title.fis').fadeOut(400, function() {
            $(this).removeClass('fis').prev().fadeIn().addClass('fis');
        });
    } else {
        $('.slide_item_title.fis').fadeOut(400, function() {
            $('.slide_item_title').removeClass('fis');
            $('.slide_item_title:last-of-type').fadeIn().addClass('fis');
        });
    }

}