$(document).ready(function(){
    var x;
    $(".main-menu li").mouseenter(function(){
        var that = $(this);
        x = setTimeout(function(){
            that.children("div").slideDown(200);
        }, 500);
    });
    $(".main-menu li").mouseleave(function(){
        clearTimeout(x);
        $(this).children("div").slideUp(10);
    });
});
$(document).ready(function(){
    $("#sign-up").click(function(){
        $("#modal-signup").modal();
    });
});
$(document).ready(function(){
    $("#log-in").click(function(){
        $("#modal-login").modal();
    });
});
/*$(document).ready(function(){
    $("#log-out").click(function(){
        $.ajax({
                    // The link we are accessing.
                    url: "logout.php",
                        
                   // The type of request.
                    type: "get",
                        
                    // The type of data that is getting returned
                    success: function(){
                        window.location.href = "./index.php";
                    }
               });
    });
});*/
$(document).ready(function(){
    $(".item_small").mouseleave(function(){
    	$(this).find(".decsription").css("bottom","60px");
        $(this).find(".decsription").animate({bottom: '0'});
    });
});
$(document).ready(function(){
    $(".main-menu-list li").click(function(){
        $(this).children("div").slideToggle("100");
         //return false;
    });
});
$(document).ready(function(){
    var offset = 106,
        offset_opacity = 1200,
        scroll_top_duration = 700;
    $(window).scroll(function(){
        if($(this).scrollTop() > offset){
            $(".container-fluid > nav").addClass("nav-fixed");
           // $(".sub-main-menu").css("top","40px");
            $(".main-menu-hide").addClass("main-menu-hide-fixed");
            $(".back-to-top").css("visibility", "visible");
        }
        else {
            $(".container-fluid > nav").removeClass("nav-fixed");
            //$(".sub-main-menu").css("top","0");
            $(".back-to-top").css("visibility", "hidden");  
            $(".main-menu-hide").removeClass("main-menu-hide-fixed");         
        }
    });
});
$(document).ready(function(){
    $(".back-to-top").mouseenter(function(){
       // if ($(this).css("opacity") >= 0.5) {
            $(this).animate({opacity: '0.9'},300);
            $(this).children(".glyphicon-arrow-up").animate({top: '-5px'},300);
       // }
    });
    $(".back-to-top").mouseleave(function(){
       //  if ($(this).css("opacity") > 0.5) {
            $(this).animate({opacity: '0.5'},300);
            $(this).children(".glyphicon-arrow-up").animate({top: '5px'},10);
        //}
    });
});
$(document).ready(function(){
    $("nav > a").click(function(){
        $(".main-menu-hide").slideToggle();
        return false;
    });
});
    $(document).ready(function(){
     $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $('#back-to-top').tooltip('show');
});
$(document).ready(function(){
    $(".main-menu-hide").mouseleave(function(){
        $(".main-menu-hide").slideUp(10);
    });
    var that =  $(".main-menu-hide").siblings();
    $(that).click(function(){
        $(".main-menu-hide").slideUp(10);
    });
});
