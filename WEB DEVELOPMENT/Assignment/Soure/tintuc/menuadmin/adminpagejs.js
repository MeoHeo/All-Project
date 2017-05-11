$(document).ready(function(){
    $('.menu-admin > ul >li').click(function(){
        $(this).find('div').slideToggle(10);
    });
    /*-----kiểm tra phim bộ hay phim lẻ----*/
    $('#loaiphim').change(function(){
        if ($('#phimbo').is(':checked')) {
            $('#duongdan').hide();
            $('#sotap').show();
        }
        else {
            $('#duongdan').show();
            $('#sotap').hide();
        }
    });
    $('#sotapinput').blur(function(){
        var sotap = parseInt($("#sotapinput").val());
        if (sotap < 1||isNaN(sotap)) {
            alert("số tập phim không đúng!");
        }
        else {
            $('#linktapphimbo table').remove();
            for (var i = 0; i < sotap; i++) {
                var tr = document.createElement('tr');
                var td1 = document.createElement('td');
                td1.textnode(i+1);
                var td1 = document.createElement('td');
                td1.textnode(i+1);
                var node = "<tr><td>1</td></tr>";
                $('#linktapphimbo table').append(node);
            }
        }
    });
}); 