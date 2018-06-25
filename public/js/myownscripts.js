$(document).ready(function(){
    $('#replydelete, #postreplydelete').on('click', function () {
        $('#spanwithtextreply').html('');
        $('#authoreply').html('');
        $('.visiblereply').hide();
        $('input[name="towhoreplyname"]').val(0);
        $('input[name="towhoreplytext"]').val(0);
        $('#divwithtextarea').removeClass('textareainreply');
    });

    $('[data-toggle="tooltip"]').tooltip();
    //POLL
    $('.btnhover').on('click', function () {
        if($('.radiochecker').is(':checked')) {
            $('.alertaftervote').fadeIn('fast');
            $(this).addClass('btnchecked');
            $(this).attr('disabled', true);
            var radioval = $('input[name=opt]:checked').val();
            var beforewidth =  $('.polloption' + radioval).width();
            var morewidth = beforewidth + 10;
            var lesswidth = beforewidth - 5;
            $('.polloption' + radioval).width(morewidth);
            $('.progress-bar').not('.polloption' + radioval).css("width", "-=5");
            $('input[name=opt]').not('input[name=opt]:checked').attr('disabled', true);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
                url: '/pollvotemethod',
                type: 'post',
                data: {'radioval': radioval}
            });
            $('.alertaftervote').delay(3500).fadeOut(500);
        }
    });
    $('html, body').not($('.searchingresult, .singlesearch, .searcher')).on('click', function (e) {
        //$('.searchingresult').fadeOut(200);
        if (!$(e.target).is('.searchingresult, .singlesearch, .searcher')) {
            if ($('.searchingresult').is(':visible')) {
                $('.searchingresult').fadeOut(200);
            }
        }

    });

    var typingTimer;                //timer identifier
    var doneTypingInterval = 200;

    $('.searcher').keyup( function () {
        if($('.searcher').val() == '') {
            $('.searchingresult').fadeOut(200);
        }
        clearTimeout(typingTimer);
        if ($('.searcher').val()) {
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            }


    });
    function doneTyping () {
        //do something
        $('.searchingresult').empty();
        var searchingfor = $('.searcher').val();
        if(searchingfor == '') {
            $('.searchingresult').fadeOut(300);
        } else {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
                url: '/searchermethod',
                type: 'get',
                data: {'searchingfor': searchingfor},
                success: function(data) {
                    var titles = data[0];
                    var comments = data[1];
                    var id = data[2];
                    var arrayslength = titles.length;
                    var searcherval =  $('.searcher').val();
                    if(arrayslength ==0) {
                        $('.searchingresult').fadeOut(200);
                    } else {
                        if (searcherval.replace(/\s/g, '').length) {
                            for (i = 0; i < arrayslength; i++) {
                               $('.searchingresult').append('<a href = "/post/' + id[i] + '"><div class="singlesearch">' + titles[i] + '<i class="fa fa-comments-o fainsearch"></i><span class="commentscount">' + comments[i] + '</span></div></a>');
                            }
                            $('.searchingresult').fadeIn(200);
                        }
                    }
                }
            });
        }
    }

    $("#emote1").on('click', function () {
        document.getElementById('reply').value += '😊';
    });$("#emote2").on('click', function () {
        document.getElementById('reply').value += '😛';
    });$("#emote3").on('click', function () {
        document.getElementById('reply').value += '😉';
    });$("#emote4").on('click', function () {
        document.getElementById('reply').value += '😢';
    });$("#emote5").on('click', function () {
        document.getElementById('reply').value += '😮';
    });$("#emote6").on('click', function () {
        document.getElementById('reply').value += '😯';
    });$("#emote7").on('click', function () {
        document.getElementById('reply').value += '😧';
    });$("#emote8").on('click', function () {
        document.getElementById('reply').value += '😫';
    });$("#emote9").on('click', function () {
        document.getElementById('reply').value += '😭';
    });$("#emote10").on('click', function () {
        document.getElementById('reply').value += '😠';
    });

});

//THIS IS IT BAKCER CHAKER OMG WTF
document.addEventListener('DOMContentLoaded', function () {
   var ibackbutton = document.getElementById("backbuttonstate");
   if (ibackbutton.value == "0") {
     // Page has been loaded for the first time - Set marker
     ibackbutton.value = "1";
     $('.alertmain').not('.alertaftervote').show();
     $('.alertmain').delay(3500).fadeOut(500);
   } else {
     // Back button has been fired.. Do Something different..
     $('.alertmain').hide();
   }
}, false);

window.onscroll = function() {myFunction()};

// Get the navbar
var navbar = document.getElementById("navmainid");

// Get the offset position of the navbar
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("stickie")
        $('.content').addClass('padding75');
    } else {
        navbar.classList.remove("stickie");
        $('.content').removeClass('padding75');
    }
}
