
     var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-42119746-1']);
_gaq.push(['_trackPageview']);
(function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

$(function () {
    var all_classes = "";
    var timer = undefined;
    $.each($('li', '.social-class'), function (index, element) {
        all_classes += " btn-" + $(element).data("code");
    });
    $('li', '.social-class').mouseenter(function () {
        var icon_name = $(this).data("code");
        if ($(this).data("icon")) {
            icon_name = $(this).data("icon");
        }
        var icon = "<i class='fa fa-" + icon_name + "'></i>";
        $('.btn-social', '.social-sizes').html(icon + "Sign in with " + $(this).data("name"));
        $('.btn-social-icon', '.social-sizes').html(icon);
        $('.btn', '.social-sizes').removeClass(all_classes);
        $('.btn', '.social-sizes').addClass("btn-" + $(this).data('code'));
    });
    $($('li', '.social-class')[Math.floor($('li', '.social-class').length * Math.random())]).mouseenter();
});
//function openLoginView() {
//    $('<iframe>', {
//        src: "/Login/Index",
//        class: "embed-responsive-item",
//        id: 'loginViewFrame',
//        frameborder: 0,
//        scrolling: 'no',
//    }).appendTo('#loginViewDiv');

//    $("body").css("background-color", "gray"); 
//    //alert("1");
//}
//function closeLoginView() {
//    $("loginViewFrame").remove();
//    $("body").css("background-color", "white");
//}
//$(document).ready(function () {
//    //alert("2");
//    $("#openLoginView").click(openLoginView);

//    $('#loginViewFrame').load(function () {
//        $("#loginClose").click(closeLoginView);
//        alert("hell");
//    });
//});
